<?php
require 'functions.php'; // 封装函数

// 获取小组名称
$groupName = $_GET['group'] ?? ''; // 从 URL 参数获取小组名
$groupKey = getGroupKey($groupName); // 获取映射后的小组键

// 读取数据文件
$pointsFile = 'points.json';
$points = getJsonData($pointsFile);

// 检查是否存在该小组信息
if (!isset($points[$groupKey])) {
    die("Error: 未找到该小组信息！");
}

// 获取小组成员和总分
$groupMembers = $points[$groupKey]['members'] ?? [];
$groupTotalScore = $points[$groupKey]['group_total'] ?? 0;

// 处理加减分操作
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 检查密码
    $adminPassword = '123456'; // 预设的管理员密码
    $password = $_POST['password'] ?? '';

    if ($password !== $adminPassword) {
        die("Error: 密码错误！");
    }

    // 操作小组总分
    $scoreChange = $_POST['score'] ?? 0;
    $operation = $_POST['operation'] ?? '';

    if ($operation == 'add') {
        $groupTotalScore += $scoreChange;
    } elseif ($operation == 'subtract') {
        $groupTotalScore -= $scoreChange;
    }

    // 更新小组总分到 points.json
    $points[$groupKey]['group_total'] = $groupTotalScore;
    saveJsonData($pointsFile, $points);

    // 刷新页面
    header("Location: group.php?group=" . urlencode($groupName));
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>小组信息 - 德育分管理系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .member-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #4CAF50;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        form {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="number"],
        input[type="password"],
        select {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-home {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-home:hover {
            background-color: #45a049;
        }

        .group-total {
            text-align: center;
            font-size: 18px;
            color: #4CAF50;
            margin: 20px 0;
        }

        .score-form {
            margin-top: 30px;
        }

        .score-form input[type="number"],
        .score-form input[type="password"],
        .score-form select {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<header>
    <?php
    // 输出小组名称
    if (is_string($groupName)) {
        echo htmlspecialchars($groupName);  // 确保 $groupName 是字符串类型才执行
    } else {
        echo "Invalid group name";  // 如果不是字符串类型，输出错误信息
    }
    ?>
</header>

<div class="container">
    <a href="index.php" class="back-home">返回首页</a> <!-- 返回首页链接 -->

    <div class="group-total">
        <p>小组总分：<?= htmlspecialchars($groupTotalScore) ?></p> <!-- 显示小组总分 -->
    </div>

    <!-- 小组加减分表单 -->
    <div class="score-form">
        <h3>操作小组总分</h3>
        <form method="POST" action="">
            <label for="score">分数：</label>
            <input type="number" name="score" required>
            <label for="operation">操作：</label>
            <select name="operation" id="operation">
                <option value="add">加分</option>
                <option value="subtract">减分</option>
            </select>
            <label for="password">管理员密码：</label>
            <input type="password" name="password" required>
            <button type="submit">提交</button>
        </form>
    </div>

    <div class="member-list">
        <h2>成员列表</h2>
        <?php foreach ($groupMembers as $member): ?>
            <div class[_{{{CITATION{{{_1{](https://github.com/Dent24/shoppingCart/tree/48ead25dbe4725fd8eb718671c9053d75269775d/MVCmod%2Fviews%2FoneProduct.php)