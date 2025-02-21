<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, <?php echo e($name); ?></h1>
     <form action="about"method="post">
        <?php echo csrf_field(); ?>
        <input type="text"name="name"id="name"><br><br>
         <select name="department" id="department">
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>"><?php echo e($department); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select><br><br>
        <input type="submit" value="send">
    </form>

</body>
</html>
<?php /**PATH D:\laravel-course\tasks-list\resources\views/about.blade.php ENDPATH**/ ?>