@extends('layout.default')

@section('content')
    <!-- Heading -->
    <div class="col-sm-12 mb-5">
        <h1 class="text-uppercase g-color-main-light-v1 g-font-weight-600 g-letter-spacing-2 mb-4"
            style="font-size: 32px;">
            Api Integration
        </h1>
        <p class="g-font-size-16">
            Hey, I'm an API Integration Demo.<br />
            I can connect with an API, pull information and show you it.<br/>
            Try me and see what happens. If you like it and want it on your site,
            <a href="https://www.rossedlin.com/hire/" target="_blank"> contact / hire me here.</a>
        </p>
        <p class="g-font-size-16">
            I'm making use of
            <a href="https://laravel.com/" target="_blank">Laravel</a> as a backend framework,
            <a href="https://packagist.org/packages/guzzlehttp/guzzle" target="_blank">Guzzle</a> for the API request and
            <a href="https://jsonschema.net/" target="_blank">JSON Schema</a> for validation.
        </p>
    </div>
    <!-- End Heading -->

    <hr/>

    <!-- Web Scraping Form -->
    <div class="col-sm-12 mt-5">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12 form-group g-mb-20">
                        <label class="g-color-gray-dark-v2 g-font-size-13">URL</label>
                        <input id="api-integration-url"
                               class="form-control"
                               type="text"
                               placeholder="https://reqres.in/api/users?page=2"
                               value="https://reqres.in/api/users?page=2" disabled>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-12 form-group">
                        <button id="api-integration-button"
                                class="btn btn-primary"
                                role="button"
                                onclick="getRequestThreeSecs();">
                            <span style="padding: 0 10px">Click me to call API</span>
                            <span class="fa fa-spinner fa-spin" style="display: none; font-size:18px"></span>
                        </button>
                    </div>
                    <div class="col-sm-12 form-group">
                        <div id="api-integration-info"
                             style="padding: 10px 0;"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group g-mb-20">
                        <p class="g-font-size-18 mb-0">
                            Have a look at <a href="https://reqres.in" target="_blank">https://reqres.in</a> for
                            testing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="g-mb-40">
                    <label class="g-color-gray-dark-v2 g-font-size-13">Api Integration Result</label>
                    <textarea id="api-integration-result"
                              class="form-control"
                              rows="6" placeholder="A dump for the api integration result"></textarea>
                </div>
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

            $('#api-integration-result').val('');
            $('#api-integration-button').find('.fa-spinner').show();
            $('#api-integration-info').html('Requesting in 3...');

            setTimeout(getRequestTwoSecs, 1000);
        }

        /**
         *
         */
        function getRequestTwoSecs() {
            $('#api-integration-info').html('Requesting in 3... 2...');

            setTimeout(getRequestOneSecs, 1000);
        }

        /**
         *
         */
        function getRequestOneSecs() {
            $('#api-integration-info').html('Requesting in 3... 2... 1...');

            setTimeout(getRequest, 1000);
        }

        /**
         *
         */
        function getRequest() {

            $('#api-integration-info').html('Requesting...');

            $('#api-integration-result').val('');
            $('#api-integration-button').find('.fa-spinner').show();

            $.post('<?= url('api/api-integration/get-request') ?>', {
                url:    $('#api-integration-url').val(),
                _token: '<?= csrf_token(); ?>'
            })
             .done(function (jsonString, textStatus, jqXHR) {

                 var jsonObj = $.parseJSON(jsonString);

                 $('#api-integration-result').val(jsonString);
                 $('#api-integration-button').find('.fa-spinner').hide();
                 $('#api-integration-info').html('Done!');
                 $('#results-table').html(jsonObj['html']);

             })
             .fail(function (jqXHR, textStatus, errorThrown) {

             });
        }

    </script>
@stop