<!-- <!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
</head>

<body>
    <h1><?php echo $title; ?></h1>
    <p>This is the home page.</p>
</body>

</html> -->

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
</head>

<body>
    <h1><?php echo $title; ?></h1>
    <?php if (isset($user)): ?>
        <p>User ID: <?php echo $user['id']; ?></p>
        <p>Name: <?php echo $user['username']; ?></p>
    <?php else: ?>
        <p>This is the home page.</p>
    <?php endif; ?>
</body>

</html>