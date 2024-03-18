<?php
namespace App\WebScraper;

use GuzzleHttp\Client;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/09/2017
 * Time: 11:30
 */
abstract class AbstractWebScraper
{
	/**
	 * @param string $baseUrl
	 * @param array  $args
	 *
	 * @return array
	 * @throws \Exception
	 */
	abstract public function scrape($baseUrl, array $args = []);

	/**
	 * @param        $baseUrl
	 * @param string $subUrl
	 *
	 * @return string
	 */
	protected static function getHtmlFromUrl($baseUrl, $subUrl = '/')
	{
		$client = new Client([
			'base_uri' => $baseUrl,
			'timeout'  => 5.0,
		]);

		/**
		 * Request HTML
		 */
		$response = $client->request('GET', $subUrl);
		$body     = $response->getBody();
		$html     = $body->getContents();

		return $html;
	}

	/**
	 * @param $html
	 * @param $filter
	 *
	 * @return array
	 */
	protected static function filterHtmlArray($html, $filter)
	{
		try
		{
			$crawler  = new Crawler($html);
			$articles = $crawler
				->filter($filter)
				->each(function (Crawler $node)
				{
					return $node->html();
				});

			return $articles;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}

	/**
	 * @param $html
	 * @param $filter
	 *
	 * @return string
	 */
	protected static function filterHtmlSingle($html, $filter)
	{
		try
		{
			$crawler  = new Crawler($html);
			$articles = $crawler->filter($filter)->html();

			return $articles;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}

	/**
	 * @param $html
	 * @param $filter
	 *
	 * @return string
	 */
	protected static function filterHref($html, $filter)
	{
		try
		{
			$crawler = new Crawler($html);
			$link    = $crawler->filter($filter)->attr('href');
			return $link;
		}
		catch (\Exception $e)
		{
			return false;
		}
	}

    /**
     * @param $html
     * @param $filter
     *
     * @return string
     */
    protected static function filterSrc($html, $filter)
    {
        try
        {
            $crawler = new Crawler($html);
            $link    = $crawler->filter($filter)->attr('src');
            return $link;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}
