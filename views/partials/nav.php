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
                "logOut" => <<<EOT
                    <a href="/logOut" class="hover:text-indigo-500 py-1 px-3 text-2xl">
                        <li class="list-none"><i class="fa-solid fa-arrow-right-from-bracket"></i></li>
                    </a>
                EOT
            );

            if (!isset($buttonsHeader)) {
                $buttonsHeader = 0; // Default to 0 if not set
            }

            if ($buttonsHeader == 0){
                echo $buttonsList["register"] . $buttonsList["login"] . $buttonsList["home"];
            } elseif ($buttonsHeader == 1){
                echo $buttonsList["login"] . $buttonsList["home"];
            } elseif ($buttonsHeader == 2){
                echo $buttonsList["register"] . $buttonsList["home"];
            } else {
                echo $buttonsList["home"] . $buttonsList["logOut"];
            }
        ?>
    </ul>
</nav>
