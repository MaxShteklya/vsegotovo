<h1></h1>
<?php
if(isset($errors)){
    echo "<div class='well'>";
    foreach($errors as $error){
        echo "<h3 class='error'>".$error."</h3>";
    }
    echo "</div>";
}
?>
<form action="/admin/editpromo/<?php echo $promo['id']?>" method="post" enctype="multipart/form-data">
    <div class="block">
        <h2>Выбрать другое фото:</h2>
        <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" />
        <label class="filelabel" for="fileToUpload"><span>Выбрать файл</span></label>
    </div>

    <div class="block">
        <h2>Название:</h2>
        <input class="title_input" type="text" name="title" placeholder="Название" value="<?=$promo['title']?>">
    </div>

    <div class="block">
        <h2>Описание:</h2>
        <textarea name="content" rows="10" cols="80"><?=$promo['descr']?></textarea>
    </div>

    <button class="submit-btn" type="submit">
        Сохранить
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
        $(".submit-btn").click(function (event) {
            event.preventDefault()
            var del = confirm("Вы уверенны, что хотите изменить эту акцию?")
            if(del) $("form").submit();
        })
    })
</script>
