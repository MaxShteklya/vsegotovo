<h1>Редактировать акции</h1>
<div class="tours container-fluid centered row">
    <?php $i = 0; ?>

    <?php foreach($promos as $promo): ?>
        <?php
        $promo_active = "";
        if($promo['status'] == 0) $promo_active = "disactived";
        ?>
        <div class="col-12 col-md-6 col-lg-4 <?=$promo_active?>">
            <div class="inner-tour">
                <a href="/promo/<?php echo $promo['id']; ?>">
                    <div class="preview" style="height: auto!important;overflow:hidden"><img src="/<?=$promo['image']?>" style="width: 100%"></div>
                </a>
                <div class="inner-text">
                    <a href="/promo/<?php echo $promo['id']; ?>"><h3><?php echo $promo['title']; ?></h3></a>
                    <p class="tour_way"><?=$promo['descr']; ?></p>
                    <table class="edit">
                        <tr>
                            <td class="edit-btn">
                                <a class="btn-more-y div_a" href="/admin/editpromo/<?php echo $promo['id']; ?>">Редактировать</a>
                            </td>
                            <td class="del-btn">
                                <a class="btn-del div_a" href="/admin/deletepromo/<?php echo $promo['id']; ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="disactive-btn" colspan="2">
                                <a class="btn-more-y div_a" href="/admin/changepromostatus/<?php echo $promo['id']."_".$promo['status']; ?>">
                                    <?php
                                    if($promo['status'] == 0) echo "Активировать";
                                    else echo "Деактивировать";
                                    ?>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>
    <?php
    if($i==0){
        echo "Акций пока нет. <a href='/admin/addpromo'>Добавить</a>";
    }
    ?>
</div>
<script>
    $(function () {
        $(".btn-del").click(function (event) {
            event.preventDefault()
            var del = confirm("Вы уверены в том, что хотите удалить эту акцию?")
            if(del) window.location.href = $(this).attr("href");
        })
    })
</script>
