<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<body>

    <div class="container">
        <h2>Pure Image Dropdown</h2>
        <p>Click the image to see the dropdown</p>
        <div class="dropdown">
            <a href="#" id="imageDropdown" data-toggle="dropdown">
                <img src="https://picsum.photos/50">
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 1</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 2</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>
            </ul>
        </div>
    </div>

</body>
