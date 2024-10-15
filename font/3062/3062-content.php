<?php
$url_host = $_SERVER['HTTP_HOST'];

$pattern_document_root = addcslashes(realpath($_SERVER['DOCUMENT_ROOT']), '\\');

$pattern_uri = '/' . $pattern_document_root . '(.*)$/';

preg_match_all($pattern_uri, __DIR__, $matches);

$url_path = $url_host . $matches[1][0];

$url_path = str_replace('\\', '/', $url_path);
?>
<div class="type-3062">

    <div id="singlefeature" class="single-feature post-73 bg--img"
        style="background-image: url(&quot;http://themelooks.us/demo/bizwalls/wordpress/wp-content/uploads/2017/05/single-feature-bg-02-1.png&quot;);">
        <div class="container">
            <div class="row">
                <div class="col-md-7 single-feature--content text--white ">
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <div class="single-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam cum delectus, sunt eos esse
                            quasi dignissimos. Minima deserunt nobis molestias voluptatum ut sunt sapiente quia? Totam
                            consequatur, excepturi error sint.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam cum delectus, sunt eos esse
                            quasi dignissimos.</p>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-xxs-12">
                            <ul>
                                <li>Lorem ipsum dolor sit</li>
                                <li>Lorem ipsum dolor sit</li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-xxs-12">
                            <ul>
                                <li>Lorem ipsum dolor sit</li>
                                <li>Lorem ipsum dolor sit</li>
                            </ul>
                        </div>
                    </div><a href="#" class="btn btn-custom-reverse">Learn More</a>
                </div>
                <div class="col-md-5 single-feature--image">
                    <figure>
                        <img src="http://themelooks.us/demo/bizwalls/wordpress/wp-content/uploads/2017/05/single-feature-02-1.png"
                            alt="single feature 02 1" class="img-responsive">
                        <figcaption class="tag-right single-feature--price">
                            <span>Price</span>
                            <p>$9.99</p><span>USD</span>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>

</div>