<nav class="flex justify-between items-center px-10 w-auto h-[5%] bg-purple-900 text-white font-semibold">
    <div class="bg-white w-9 h-9 rounded-full"></div>
    <ul class="list-none flex justify-between items-center gap-4">
        <?php
            $buttonsList = array(
                "register" => <<<EOT
                    <a href="/register" class="bg-rose-500 hover:text-indigo-500 hover:bg-white py-1 px-3 text-xl">
                        <li class="list-none">Register</li>
                    </a>
                EOT,
                "login" => <<<EOT
                    <a href="/login" class="bg-indigo-500 hover:text-indigo-500 hover:bg-white py-1 px-3 text-xl">
                        <li class="list-none">Login</li>
                    </a>
                EOT,
                "home" => <<<EOT
                    <a href="/" class="hover:text-indigo-500 py-1 px-3 text-2xl">
                        <li class="list-none"><i class="fa-solid fa-house"></i></li>
                    </a>
                EOT,
                "logout" => <<<EOT
                    <a href="/logout" class="hover:text-indigo-500 py-1 px-3 text-2xl">
                        <li class="list-none"><i class="fa-solid fa-arrow-right-from-bracket"></i></li>
                    </a>
                EOT,
                "dashboard" => <<<EOT
                    <a href="/dashboard" class="hover:text-indigo-500 py-1 px-3 text-2xl">
                        <li class="list-none"><i class="fa-solid fa-table-columns"></i></li>
                    </a>
                EOT,
            );
            
            if ($uri== '/' || $uri == '/forgetPassword'){

                echo $buttonsList["register"] . $buttonsList["login"] . $buttonsList["home"];

            } elseif ($uri == '/register'){

                echo $buttonsList["login"] . $buttonsList["home"];

            } elseif ($uri == '/login'){

                echo $buttonsList["register"] . $buttonsList["home"];

            } else if ($uri == '/newBlog' || $uri == '/blog' || $uri == '/profile' || $uri == '/editProfile') {

                echo $buttonsList["dashboard"] . $buttonsList["home"] . $buttonsList["logout"];

            } else {

                echo $buttonsList["home"] . $buttonsList["logout"];
                
            }
        ?>
    </ul>
</nav>
