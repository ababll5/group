<?php
require 'functions.php'; // 封装函数

// 数据文件路径
$pointsFile = 'points.json';

// 读取数据文件
$points = getJsonData($pointsFile);

// 获取小组总分
$groups = getGroups();
$groupTotalScores = getGroupTotalScores($points, $groups);

// 获取学生分数（周总分和学期总分）
$studentWeeklyScores = [];
$studentSemesterScores = [];

foreach ($points as $groupKey => $group) {
    if (isset($group['members']) && is_array($group['members'])) {
        foreach ($group['members'] as $member) {
            $studentWeeklyScores[$member['name']] = $member['weekly_total'];
            $studentSemesterScores[$member['name']] = $member['semester_total'];
        }
    }
}

arsort($groupTotalScores);
arsort($studentWeeklyScores);
arsort($studentSemesterScores);
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>德育分管理系统</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    德育分管理系统
</header>

<div class="container">
    <!-- 小组排名 -->
    <div class="ranking-container">
        <h2>小组排名</h2>
        <?php foreach ($groupTotalScores as $groupName => $score): ?>
            <div class="card">
                <h3><?= htmlspecialchars($groupName) ?></h3>
                <p>总分：<?= htmlspecialchars($score) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 学生周排名 -->
    <div class="student-ranking">
        <h2>学生周排名</h2>
        <?php foreach ($studentWeeklyScores as $studentName => $weeklyScore): ?>
            <div class="card">
                <h3><?= htmlspecialchars($studentName) ?></h3>
                <p>本周总分：<?= htmlspecialchars($weeklyScore) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 学生学期排名 -->
    <div class="student-ranking">
        <h2>学生学期排名</h2>
        <?php foreach ($studentSemesterScores as $studentName => $semesterScore): ?>
            <div class="card">
                <h3><?= htmlspecialchars($studentName) ?></h3>
                <p>学期总分：<?= htmlspecialchars($semesterScore) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 小组列表 -->
    <div class="group-container">
        <h2>小组列表</h2>
        <?php foreach ($groups as $groupName => $groupKey): ?>
            <?php if (isset($points[$groupKey])): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($groupName) ?></h3>
                    <p>总分：<?= htmlspecialchars($points[$groupKey]['group_total']) ?></p>
                    <a href="group.php?group=<?= urlencode($groupName) ?>" class="btn-view">查看成员</a>
                </div>
            <?php else: ?>
                <div class="card">
                    <h3><?= htmlspecialchars($groupName) ?></h3>
                    <p>总分：0</p>
                    <a href="group.php?group=<?= urlencode($groupName) ?>" class="btn-view">查看成员</a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<div style="text-align:center; margin-top: 20px;">
    <a href="index.php" class="btn-back">返回主页</a>
</div>

<footer>
    © 2024 德育分管理系统 - All Rights Reserved
</footer>

</body>
</html>
