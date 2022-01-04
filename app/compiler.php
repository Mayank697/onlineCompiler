<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];

    // creating files in temp folder of the code
    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;

    // now write the code inside the created file
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    // execute program
    if($language == "php") {
        $output = shell_exec("php $filePath 2>&1");
        echo $output;
    }
    else if($language == "python") {
        $output = shell_exec("python3 $filePath 2>&1");
        echo $output;
    }
    else if($language == "node") {
        rename($filePath, $filePath.".js");
        $output = shell_exec("node $filePath.js 2>&1");
        echo $output;
    }
    else if($language == "c") {
        $outputExe = $random;
        chmod("$filePath", 0777);
        echo shell_exec("cd temp && gcc $random.c -o $random 2>&1");
        $output = shell_exec("cd temp && ./$outputExe 2>&1");
        echo $output;
    }
    else if($language == "cpp") {
        $outputExe = $random;
        chmod("$filePath", 0777);
        echo shell_exec("cd temp && g++ $random.cpp -o $random 2>&1");
        $output = shell_exec("cd temp && ./$outputExe 2>&1");
        echo $output;
    }