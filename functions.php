<?php
function getGroups() {
    return [
        '小组1' => 'G1',
        '小组2' => 'G2',
        '小组3' => 'G3',
        '小组4' => 'G4',
        '小组5' => 'G5',
        '小组6' => 'G6',
        '小组7' => 'G7',
        '小组8' => 'G8'
    ];
}

function getGroupKey($groupName) {
    $groupMapping = getGroups();

    if (!isset($groupMapping[$groupName])) {
        die("Error: 未找到该小组信息！");
    }

    return $groupMapping[$groupName];
}

function getJsonData($filePath) {
    if (!file_exists($filePath)) {
        die("Error: $filePath 文件未找到！");
    }
    return json_decode(file_get_contents($filePath), true);
}

function saveJsonData($filePath, $data) {
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
}

function validateFormInput($input, $requiredFields) {
    foreach ($requiredFields as $field) {
        if (!isset($input[$field]) || trim($input[$field]) === '') {
            return false;
        }
    }
    return array_map('htmlspecialchars', $input);
}

function updateGroupScore($scoreChange, $operation, $currentScore) {
    if ($operation === 'add') {
        $currentScore += $scoreChange;
    } elseif ($operation === 'subtract') {
        $currentScore -= $scoreChange;
    }
    return $currentScore;
}

function getGroupTotalScores($points, $groups) {
    $groupTotalScores = [];
    foreach ($groups as $groupName => $groupKey) {
        if (!isset($points[$groupKey]) || !is_array($points[$groupKey])) {
            $points[$groupKey] = ['group_total' => 0];
        }
        $groupTotalScores[$groupName] = $points[$groupKey]['group_total'];
    }
    return $groupTotalScores;
}
?>
