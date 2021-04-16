<?php

declare(strict_types=1);

namespace Texastrucking\WebScraping;

use InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;

class CoMemSearchCrawler
{
    private string $path;

    private Crawler $crawler;

    /**
     * CoMemSearchCrawler constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("The given file path \"{$path}\" doesn't exists.");
        }

        $this->path = $path;
        $this->crawler = new Crawler(file_get_contents($this->path));
    }

    public function getData(): array
    {
        $data = [];

        $this->crawler->filter('#results div.inner')->each(function (Crawler $node) use (&$data) {
            $companyName = $node->filter('h5')->text();

            $arr = [];
            $node->filter('div.contactWrap div.mbrmax-row')->each(function (Crawler $row) use (&$arr) {
                if ($row->filter('.fa-phone-alt')->count() === 1) {
                    $arr['phone'] = $row->text();
                    return;
                }

                if ($row->filter('.fa-globe')->count() === 1) {
                    $arr['website'] = $row->filter('a')->attr('href');
                    return;
                }

                $txt = $row->text();

                if (strpos($txt, 'Email:') !== false) {
                    $nameArr = array_map('trim', explode('Email:', $txt));
                    $arr['contactName'] = array_shift($nameArr);
                    $arr['contactEmail'] = array_shift($nameArr);
                    return;
                }

                if (strpos($txt, 'Trailer Types:') !== false) {
                    $trailerTypes = explode('Trailer Types:', $txt);
                    array_shift($trailerTypes);
                    $trailerTypes = array_filter($trailerTypes);
                    $arr['trailerTypes'] = empty($trailerTypes) ? [] : array_map('trim', explode(',', $trailerTypes[0]));
                    return;
                }

                if (strpos($txt, 'Commodities Hauled:') !== false) {
                    $commoditiesHauled = explode('Commodities Hauled:', $txt);
                    array_shift($commoditiesHauled);
                    $commoditiesHauled = array_filter($commoditiesHauled);
                    $arr['commoditiesHauled'] = empty($commoditiesHauled) ? [] : array_map('trim', explode(',', $commoditiesHauled[0]));
                    return;
                }

                $arr['address'] = $txt;

            });


            $data[] = array_merge([
                'companyName' => $companyName,
                'contactName' => null,
                'contactEmail' => null,
                'address' => null,
                'phone' => null,
                'website' => null,
                'trailerTypes' => [],
                'commoditiesHauled' => [],
            ], $arr);
        });

        return $data;
    }

    public function getJsonData(bool $pretty = false): string
    {
        $flags = $pretty ? JSON_PRETTY_PRINT : 0;

        return json_encode($this->getData(), $flags);
    }

    public function createCsv(string $path): bool
    {
        $fp = fopen($path, 'w');

        foreach ($this->getData() as $row) {
            $row['trailerTypes'] = implode(', ', $row['trailerTypes']);
            $row['commoditiesHauled'] = implode(', ', $row['commoditiesHauled']);
            fputcsv($fp, array_values($row));
        }

        fclose($fp);

        return true;
    }
}