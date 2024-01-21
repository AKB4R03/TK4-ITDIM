<?php
    include "service/database.php";
    session_start();
    if(isset($_SESSION["isLogin"]) == false) {
        header("location: login.php");
    }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("location: login.php");
    }

    $UserId = $_SESSION["UserId"];
    $result = $db->query("SELECT * FROM stuff WHERE UserId = '$UserId'");


    if ($result) {
        $stuffData = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Handle the error if needed
        $error = $db->error;
    }
    
    // Close the database connection
    $db->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <div class="grid w-full place-items-center rounded-lg p-4">
        <div class="-m-6 max-h-[768px] w-[calc(100%+48px)] ">
            <nav
                class="sticky top-0 z-10 block w-full max-w-full px-4 py-2 text-black bg-white border rounded-none shadow-md h-max border-white/80 bg-opacity-80 backdrop-blur-2xl backdrop-saturate-200 lg:px-8 lg:py-4">
                <div class="flex items-center justify-between text-blue-gray-900">
                    <a href="home.php"
                        class="mr-4 block cursor-pointer py-1.5 font-sans text-black font-medium leading-relaxed text-inherit antialiased">
                        Welcome <?= $_SESSION["username"] ?> !!!!
                    </a>
                    <div class="flex items-center gap-4">
                        <div class="hidden mr-4 lg:block">
                            <ul
                                class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
                                <li
                                    class="block p-1 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    <a href="addStuff.php" class="flex items-center">
                                        Add Stuff
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="flex items-center gap-x-1">
                            <form action="home.php" method="POST">
                                <button
                                    class="hidden px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:inline-block"
                                    type="submit" name="logout">
                                    <span>Log out</span>
                                </button>
                            </form>
                        </div>
                        <button
                            class="relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-inherit transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden"
                            type="button">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
    </div>


    <section class=" px-[200px] pt-[100px] z-20">
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md bg-clip-border rounded-xl ">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Name
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Description
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Qty
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Profit
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Loss
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $element) :?>
                    <tr class="even:bg-blue-gray-50/50">
                        <td class="p-4">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                <?php echo $element['name']; ?>
                            </p>
                        </td>
                        <td class="p-4">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 truncate md:text-clip">
                                <?php
                                $description = $element['description'];
                                $max_length = 50; // Set the maximum length you want
                                echo (strlen($description) > $max_length) ? substr($description, 0, $max_length) . '...' : $description;
                                ?>
                            </p>
                        </td>
                        <td class="p-4">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                <?php echo $element['qty']; ?>
                            </p>
                        </td>
                        <td class="p-4">
                            <?php echo $element['price']*2; ?>
                        </td>
                        <td class="p-4">
                            0
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>