<?php $__env->startSection('content'); ?>

<style>
    .container {
        margin-top: 40px;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .header h1 {
        margin: 0;
    }
    .btn-success {
        margin-bottom: 20px;
    }
    .table {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 15px 15px rgba(139, 0, 0, 0.5);
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 15px;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #851216;
        color: white;
    }
    .btn-primary, .btn-success, .btn-warning, .btn-danger {
        border: none;
        border-radius: 5px;
        color: white;
        width: 150px;
        height: 40px;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 5px;
        margin-top: 5px;
    }
    .btn-success { background-color: #28a745; }
    .btn-success:hover { background-color: #218838; }
    .btn-warning { background-color: #ff9900; }
    .btn-warning:hover { background-color: #e68a00; }
    .btn-danger { background-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; }
</style>
<div class="container">
    <div class="header">
        <h1>Medical Articles</h1>
        <div class="buttons">
            <a href="<?php echo e(route('adminarticle.create')); ?>" class="btn btn-primary">Write Article</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Header</th>
                <th>Description</th>
                <th>Author</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($article->header); ?></td>
                    <td><?php echo e($article->description); ?></td>
                    <td><?php echo e($article->author); ?></td>
                    <td>
                        <a href="<?php echo e($article->img); ?>" target="_blank">
                            <img src="https://i.imgur.com/Ny8airw.jpeg" alt="Article Image" style="width: 200px; height:auto;">
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo e(route('adminarticle.edit', $article->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('adminarticle.destroy', $article->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admins.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Codingan\SI46INT-KEL3-main\resources\views/admins/adminarticle/index.blade.php ENDPATH**/ ?>