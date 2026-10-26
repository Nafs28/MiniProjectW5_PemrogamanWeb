
<?php $__env->startSection('title', 'Dashboard Inventory - Laravel'); ?>

<?php $__env->startSection('content'); ?>
<div class="widgets">
    <div class="widget">
        <div class="widget-title">Total Produk</div>
        <div class="widget-value"><?php echo e($totalProducts); ?> Item</div>
    </div>
    <div class="widget">
        <div class="widget-title">Nilai Inventory</div>
        <div class="widget-value" style="color:#0f766e;">Rp <?php echo e(number_format($inventoryValue, 0, ',', '.')); ?></div>
    </div>
    <div class="widget">
        <div class="widget-title">Produk Stok Rendah</div>
        <div class="widget-value" style="color:#d97706;"><?php echo e($lowStockProducts->count()); ?> Item</div>
    </div>
    <div class="widget">
        <div class="widget-title">Total Masuk (IN)</div>
        <div class="widget-value" style="color:#16a34a;">+<?php echo e($totalIn); ?></div>
    </div>
    <div class="widget">
        <div class="widget-title">Total Keluar (OUT)</div>
        <div class="widget-value" style="color:#dc2626;">-<?php echo e($totalOut); ?></div>
    </div>
</div>

<?php if($lowStockProducts->count()): ?>
<div class="card" style="border-left: 5px solid #f59e0b;">
    <h3 style="margin-top:0;color:#b45309;">⚠️ Peringatan Produk Stok Rendah (Stock &le; Minimum Stock)</h3>
    <table>
        <thead>
            <tr><th>SKU</th><th>Nama Produk</th><th>Kategori</th><th>Stok</th><th>Min. Stok</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><code><?php echo e($lp->sku); ?></code></td>
                <td class="product-name"><?php echo e($lp->name); ?></td>
                <td><span class="badge"><?php echo e($lp->category->name); ?></span></td>
                <td><span class="badge badge-low"><?php echo e($lp->stock); ?></span></td>
                <td><?php echo e($lp->minimum_stock); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<div class="card">
    <h3 style="margin-top:0;">📊 Laporan Agregat Eloquent per Kategori (withCount, withSum, withAvg)</h3>
    <table>
        <thead>
            <tr><th>Kategori</th><th>Jumlah Produk (COUNT)</th><th>Total Unit Stok (SUM)</th><th>Rata-rata Harga (AVG)</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categoryReport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e($cat->name); ?></strong></td>
                <td><?php echo e($cat->products_count); ?> Produk</td>
                <td><?php echo e($cat->products_sum_stock ?? 0); ?> Unit</td>
                <td>Rp <?php echo e(number_format($cat->products_avg_price ?? 0, 0, ',', '.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Program\Laragon\www\inventory-laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>