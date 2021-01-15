<?php
if($added){
    echo "<div class='well'>";
    if($complete){
        echo "<h2 class='success'>Акция номер $id успешно добавлено! <a href='/promo/$id' target='_blank'>Просмтотреть её</a></h2><p><b>Не обновляйте страницу, иначе акция добавиться повторно!</b></p>";
    }else{
        foreach($errors as $error){
            echo "<h3 class='error'>".$error."</h3>";
        }
    }
    echo "</div>";
}
?>
<h1>Добавить акцию</h1>
<div class="wel"></div>
<form action="/admin/addpromo" method="post" enctype="multipart/form-data">
    <div class="block">
        <h2>Фото:</h2>
        <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" />
        <label class="filelabel" for="fileToUpload"><span>Выбрать файл</span></label>
    </div>

    <div class="block">
        <h2>Название:</h2>
        <input class="title_input" type="text" name="title" placeholder="Название">
    </div>

    <div class="block">
        <h2>Описание:</h2>
        <textarea name="content" rows="10" cols="80"></textarea>
    </div>

    <button class="submit-btn" type="submit">
        Добавить
    </button>
</form>
<script src="/public/js/jquery.cookie.js"></script>
<script>
    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function(input){
        var label	 = input.nextElementSibling,
            labelVal = label.innerHTML;
        input.addEventListener('change', function(e){
            var fileName = '';
            if( this.files )
                fileName = e.target.value.split( '\\' ).pop();
            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });
    });
</script>
<script>
    $(function () {
        $(".submit-btn").click(function () {

            var title = $("[name=title]").val();
            $.cookie("title", title, {expires : 1});

            var rus_title_content = $("[name=content]").val();
            $.cookie("content", rus_title_content, {expires : 1});

        })

        if ($.cookie('title')!=="undefined")$('[name=title]').val($.cookie('title'));
        if ($.cookie('content')!=="undefined") $('[name=content]').val($.cookie('content'));
    })
</script>
