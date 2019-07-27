<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script>
            var number = 0;
            for (var i = 1, max = 10; i <= max; i++) {
                number += i;
                document.write(" " + number);
            }

            function setColour(Colour)
            {
                document.body.style.backgroundColor = Colour;
            }
        </script>

        <input type="button" value="Red" onclick="setColour('red')"/>
        <input type="button" value="Blue" onclick="setColour('blue')"/>
        <input type="button" value="Green" onclick="setColour('green')"/>


    </body>
</html>
