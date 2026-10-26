
<?php $__env->startSection('title', 'Daftar Produk - Laravel'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px;">
        <h2 style="margin:0;">Daftar Produk Inventaris</h2>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <!-- Form Search, Filter & Sorting dengan Method GET -->
    <form method="GET" action="<?php echo e(route('products.index')); ?>" style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:16px;">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau SKU..." style="flex:1 1 200px; width:auto;">

        <select name="category_id" style="width:auto;">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>" <?php echo e((string)request('category_id') === (string)$c->id ? 'selected' : ''); ?>>
                    <?php echo e($c->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="sort" style="width:auto;">
            <option value="name" <?php echo e($sort === 'name' ? 'selected' : ''); ?>>Urut: Nama</option>
            <option value="sku" <?php echo e($sort === 'sku' ? 'selected' : ''); ?>>Urut: SKU</option>
            <option value="price" <?php echo e($sort === 'price' ? 'selected' : ''); ?>>Urut: Harga</option>
            <option value="stock" <?php echo e($sort === 'stock' ? 'selected' : ''); ?>>Urut: Stok</option>
        </select>

        <select name="dir" style="width:auto;">
            <option value="ASC" <?php echo e($dir === 'ASC' ? 'selected' : ''); ?>>Naik (ASC)</option>
            <option value="DESC" <?php echo e($dir === 'DESC' ? 'selected' : ''); ?>>Turun (DESC)</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Kategori (Eloquent)</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi (Resource Route)</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><code><?php echo e($product->sku); ?></code></td>
                    <!-- Kurung kurawal ganda Blade otomatis melakukan HTML escaping (Anti-XSS Slide 21) -->
                    <td class="product-name"><?php echo e($product->name); ?></td>
                    <td><span class="badge"><?php echo e($product->category->name); ?></span></td>
                    <td>Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                    <td>
                        <strong><?php echo e($product->stock); ?></strong>
                        <?php if($product->stock <= $product->minimum_stock): ?>
                            <span class="badge badge-low">Rendah</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-secondary btn-sm">Detail</a>
                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="<?php echo e(route('products.destroy', $product)); ?>" onsubmit="return confirm('Hapus produk ini?');" style="margin:0;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align:center;color:#64748b;">Belum ada produk yang ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 16px;">
        <?php echo e($products->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Program\Laragon\www\inventory-laravel\resources\views/products/index.blade.php ENDPATH**/ ?>