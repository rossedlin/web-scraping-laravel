<?php
/**
 * @var string $scrapeUrl
 */
?>
@extends('layout.default')

@section('content')
    <!-- Heading -->
    <div class="col-sm-12 mb-5">
        <h1 class="text-uppercase g-color-main-light-v1 g-font-weight-600 g-letter-spacing-2 mb-4"
            style="font-size: 32px;">
            Web Scraping
        </h1>
        <p class="g-font-size-16">
            Hey, I'm an Web Scraping Demo.<br/>
            I can scrape a website URL and cherry pick specific bits of information and display it in a nice table.<br/>
            Try me and see what happens. If you like it and want it on your site,
            <a href="https://www.rossedlin.com/hire/" target="_blank"> contact / hire me here.</a>
        </p>
        <p class="g-font-size-16">
            I'm making use of
            <a href="https://laravel.com/" target="_blank">Laravel</a> as a backend framework,
            <a href="https://packagist.org/packages/guzzlehttp/guzzle" target="_blank">Guzzle</a> to scrape the website
            and <a href="https://symfony.com/doc/current/components/dom_crawler.html"
                   target="_blank">Symfony Dom Crawler</a> to filter the results.


        </p>
    </div>
    <!-- End Heading -->

    <hr/>

    <!-- Web Scraping Form -->
    <div class="col-sm-12 mt-5 text-center">
        <div class="row">
            <div class="col-md-12 form-group mb-0">
                <label class="g-color-gray-dark-v2 g-font-size-13">URL</label>
            </div>

            <div class="col-md-12 form-group">
                <input class="form-control"
                       type="text"
                       placeholder="<?= $scrapeUrl ?>"
                       value="<?= $scrapeUrl ?>" disabled>
            </div>

            <div class="col-sm-12 form-group">
                <button id="web-scraping-button"
                        class="btn btn-primary"
                        role="button"
                        onclick="getRequestThreeSecs();">
                    <span style="padding: 0 10px">Click me to Scrape URL</span>
                    <span class="fa fa-spinner fa-spin" style="display: none; font-size:18px"></span>
                </button>
            </div>
            <div class="col-sm-12 form-group">
                <div id="web-scraping-info"
                     style="padding: 10px 0;"></div>
            </div>
        </div>
    </div>
    <!-- End Web Scraping Form -->

    <div id="results-table" class="col-sm-12 mt-5"></div>

    <script>

        /**
         *
         */
        function getRequestThreeSecs() {

            $('#web-scraping-result').val('');
            $('#web-scraping-button').find('.fa-spinner').show();
            $('#web-scraping-info').html('Scraping in 3...');

            setTimeout(getRequestTwoSecs, 1000);
        }

        /**
         *
         */
        function getRequestTwoSecs() {
            $('#web-scraping-info').html('Scraping in 3... 2...');

            setTimeout(getRequestOneSecs, 1000);
        }

        /**
         *
         */
        function getRequestOneSecs() {
            $('#web-scraping-info').html('Scraping in 3... 2... 1...');

            setTimeout(getRequest, 1000);
        }

        /**
         *
         */
        function getRequest() {

            $('#web-scraping-info').html('Scraping...');

            $('#web-scraping-result').val('');
            $('#web-scraping-button').find('.fa-spinner').show();

            $.post('<?= url('api/web-scraping/ross-edlin') ?>', {
                _token:       '<?= csrf_token(); ?>'
            })
             .done(function (rawHtml, textStatus, jqXHR) {

                 $('#web-scraping-button').find('.fa-spinner').hide();
                 $('#web-scraping-info').html('Done!');
                 $('#results-table').html(rawHtml);

             })
             .fail(function (jqXHR, textStatus, errorThrown) {

             });
        }

    </script>
@stop