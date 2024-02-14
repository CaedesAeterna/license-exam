<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>UI</title>

    <link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"> </script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        var list = [
            { value: "mary", label: "Mary" },
            { value: "mark", label: "Mark" },
            { value: "john", label: "John" },
        ];
        $(function () {
            $("#customer").autocomplete({
                source: list,
                minLength: 2,
                select: function (event, ui) {
                    event.preventDefault();
                    $("#customer").val(ui.item.label);
                }
            });
        })
    </script>
</head>

<body>
    <input id=customer>
</body>

</html>