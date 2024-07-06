<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Test</title>
    <meta name="keywords" content="Test" />

    <meta name="description" content="Test">
</head>
<body>
    <script type="text/javascript">
        function ChangeUrl(title, url) {
            if (typeof (history.pushState) != "undefined") {
                var obj = { Title: title, Url: url };
                history.pushState(obj, obj.Title, obj.Url);
                document.getElementsByTagName('meta')["keywords"].content = title;
                document.getElementsByTagName('meta')["description"].content = title;
                document.title = title;
            } else {
                alert("Browser does not support HTML5.");
            }
        }
    </script>
    <input type="button" value="Page1" onclick="ChangeUrl('Page1', 'Page1.htm');" />
    <input type="button" value="Page2" onclick="ChangeUrl('Page2', 'Page2.htm');" />
    <input type="button" value="Page3" onclick="ChangeUrl('Page3', 'Page3.htm');" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('popstate',function(event) {
            alert("location: " + window.location.pathname);
        });
    </script>
</body>
</html>