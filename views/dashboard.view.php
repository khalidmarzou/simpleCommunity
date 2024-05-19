<?php

    require_once './views/partials/head.php';
    $buttonsHeader = 55;
    require_once './views/partials/nav.php';

?>

<main class="py-8 z-10 font-serif w-full h-[90%] flex justify-center">
<div class="mx-auto p-5 sm:p-10 md:p-16 w-[70%] h-full overflow-auto relative">

    <div class="border-b mb-5 flex justify-between text-sm sticky top-0 z-50 bg-gray-100 px-6 py-4">
        <div class="flex items-center pb-2 pr-2 uppercase hover:text-gray-500 cursor-pointer">
            <i class="fa-solid fa-microchip"></i><pre> </pre>
            <a href="#" class="font-semibold inline-block"> Technology</a>
        </div>
        <div class="flex items-center pb-2 pr-2 uppercase hover:text-gray-500 cursor-pointer">
            <i class="fa-solid fa-flask"></i></i> <pre> </pre>
            <a href="#" class="font-semibold inline-block"> Science</a>
        </div>
        <div class="flex items-center pb-2 pr-2 uppercase hover:text-gray-500 cursor-pointer">
            <i class="fa-solid fa-medal"></i></i> <pre> </pre>
            <a href="#" class="font-semibold inline-block"> Sport</a>
        </div>
        <a href="#" class="hover:text-gray-500 border-b-2 border-indigo-600 text-indigo-600">See All</a>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
        <!-- Cards :-->
            <?php
                if($blogs){
                    foreach($blogs as $blog){
                        $category = $blog["Category"];
                        $title = $blog["Title"];
                        $content = $blog["Content"];
                        $trimmed_content = strlen($content) > 100 ? substr($content, 0, 100) . "..." : $content; // Limit content to 100 characters
                        $lastModifiedDate = $blog["LastModifiedDate"];
                        $numberCommentsBlog = 0;
                        include 'partials/card.php';
                    }
                } else {
                    echo '<br /> <br /><div class="text-3xl font-bold">No blog available until now.</div>';
                }
            ?>

    </div>
    </div>
    
    <?php require_once 'partials/profile.php'; ?>


</main>

<?php
    require_once './views/partials/footer.php';