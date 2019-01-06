<?php
include('header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".search_keyword").keyup(function()
            {
                var search_keyword_value = $(this).val();
                var dataString = 'search_keyword='+ search_keyword_value;
                if(search_keyword_value!='')
                {
                    $.ajax({
                        type: "POST",
                        url: "do_search.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#result").html(html).show();
                        }
                    });
                }
                return false;
            });
           
        });
    </script>
</head>
<body>

    <input type="text" class="search_keyword" id="search_keyword_id" placeholder="<?php echo $lang['head_search_field'] ?>" autofocus/><br />
    <div id="result"></div>
<?php
if(!empty($_GET['search_keyword'])) {
	include('do_search.php');
}

?>
</body>
</html>
<br /><br /><br /><br />
<?php
include('footer.php');
?>
