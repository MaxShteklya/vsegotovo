<div class="container mt-5 pt-3 mb-5">
    <div class="box">
        <h1>Акции</h1>
        <div class="row">
            <?php if(!isset($error)){foreach ($promos as $prom) { ?>
                <div class="col-12 col-md-6 col-lg-4 pb-5">
                    <div class="promo_card product">
                        <a href="/promo/<?=$prom['id']?>">
                            <div class="image">
                                <img src="/<?=$prom['image']?>"  alt=""/>
                            </div>
                        </a>
                        <h3>
                            <a href="/promo/<?=$prom['id']?>">
                                <?=$prom['title']?>
                            </a>
                        </h3>

                        <p class="sm_desr">
                            <?=strip_tags($prom['descr'])?>
                        </p>
                    </div>
                </div>
            <?php }}else{ echo "<p style='text-align: center;margin: auto;margin-top: 15px;'>Акций пока нету</p>"; } ?>
        </div>
    </div>
</div>
