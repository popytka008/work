
<div id="mainBlock">
    <form method="post" name="myform">
        <input type="text" name="text_id" id="text_id" value="<?=$text_id?>"/>
        <label for="text_id">ID: </label>
        <br/>
        <input type="text" name="text_title" id="text_title" value="<?=$text_title?>"/>
        <label for="text_title">Титул: </label>
        <br/>
        <label for="text_content">Контент: </label>
        <br/>
        <textarea name="text_content" id="text_content" cols="100" rows="5"><?=$text_content?></textarea>
        <br/>
        <input type="submit" name="btn_delete" value="delete" onclick="myform.command.value = 'delete';"/>
        <input type="submit" name="btn_insert" value="insert" onclick="myform.command.value = 'insert';"/>
        <input type="submit" name="btn_update" value="update" onclick="myform.command.value = 'update';"/>
        <input type="submit" name="btn_select_all" value="select_all" onclick="myform.command.value = 'select';"/>
        <input type="submit" name="btn_select" value="select" onclick="myform.command.value = 'select_id';"/>
        <br>
        <label for="result">Результат: </label>
        <br/>
        <textarea name="result" id="result" cols="100" rows="3"><?=$result?></textarea>
        <input type="hidden" name="command" value=""/>
    </form>
</div>
