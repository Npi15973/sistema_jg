 <?php $__env->startSection('content'); ?>
<?php
$general_setting= DB::table('general_settings')->latest()->first();
?>
<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center"><?php echo e(trans('file.User Report')); ?></h3>
            </div>
            <?php echo Form::open(['route' => 'report.user', 'method' => 'post']); ?>

            <div class="row">
                <div class="col-md-4 offset-md-2 mt-3">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong><?php echo e(trans('file.Choose Your Date')); ?></strong> &nbsp;</label>
                        <div class="d-tc">
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control" value="<?php echo e($start_date); ?> To <?php echo e($end_date); ?>" required />
                                <input type="hidden" name="start_date" value="<?php echo e($start_date); ?>" />
                                <input type="hidden" name="end_date" value="<?php echo e($end_date); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong><?php echo e(trans('file.Choose User')); ?></strong> &nbsp;</label>
                        <div class="d-tc">
                            <input type="hidden" name="user_id_hidden" value="<?php echo e($user_id); ?>" />
                            <select id="user_id" name="user_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins">
                                <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->phone); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"><?php echo e(trans('file.submit')); ?></button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id_hidden" value="<?php echo e($user_id); ?>" />
            <?php echo Form::close(); ?>


            <ul class="nav nav-tabs ml-4 mt-3" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#user-sale" role="tab" data-toggle="tab"><?php echo e(trans('file.Sale')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-purchase" role="tab" data-toggle="tab"><?php echo e(trans('file.Purchase')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-quotation" role="tab" data-toggle="tab"><?php echo e(trans('file.Quotation')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-transfer" role="tab" data-toggle="tab"><?php echo e(trans('file.Transfer')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-payments" role="tab" data-toggle="tab"><?php echo e(trans('file.Payment')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-expense" role="tab" data-toggle="tab"><?php echo e(trans('file.Expense')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#user-payroll" role="tab" data-toggle="tab"><?php echo e(trans('file.Payroll')); ?></a>
              </li>
            </ul>
    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="user-sale">
                    <div class="table-responsive mb-4">
                        <table id="sale-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-sale"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.customer')); ?></th>
                                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                                    <th><?php echo e(trans('file.product')); ?> (<?php echo e(trans('file.qty')); ?>)</th>
                                    <th><?php echo e(trans('file.grand total')); ?></th>
                                    <th><?php echo e(trans('file.Paid')); ?></th>
                                    <th><?php echo e(trans('file.Due')); ?></th>
                                    <th><?php echo e(trans('file.Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_sale_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key); ?></td>
                                    <?php 
                                        $warehouse = DB::table('warehouses')->find($sale->warehouse_id);
                                        $customer = DB::table('customers')->find($sale->customer_id);
                                    ?>
                                    <td><?php echo e(date($general_setting->date_format, strtotime($sale->created_at->toDateString())) . ' '. $sale->created_at->toTimeString()); ?></td>
                                    <td><?php echo e($sale->reference_no); ?></td>
                                    <td><?php echo e($customer->name); ?></td>
                                    <td><?php echo e($warehouse->name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $lims_product_sale_data[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_sale_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $product = App\Product::find($product_sale_data->product_id);
                                            $unit = App\Unit::find($product_sale_data->sale_unit_id);
                                        ?>
                                        <?php if($unit): ?>
                                            <?php echo e($product->name.' ('.$product_sale_data->qty.' '.$unit->unit_code.')'); ?>

                                        <?php else: ?>
                                            <?php echo e($product->name.' ('.$product_sale_data->qty.')'); ?>

                                        <?php endif; ?>
                                        <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(number_format((float) $sale->grand_total, 2, '.', '')); ?></td>
                                    <?php if($sale->paid_amount): ?>
				                    <td class="paid-amount"><?php echo e(number_format((float) $sale->paid_amount, 2, '.', '')); ?></td>
				                    <?php else: ?>
				                    <td>0.00</td>
				                    <?php endif; ?>
                                    <td><?php echo e(number_format((float)($sale->grand_total - $sale->paid_amount), 2, '.', '')); ?></td>
                                    <?php if($sale->sale_status == 1): ?>
                                    <td><div class="badge badge-success"><?php echo e(trans('file.Completed')); ?></div></td>
                                    <?php else: ?>
                                    <td><div class="badge badge-danger"><?php echo e(trans('file.Pending')); ?></div></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-purchase">
                    <div class="table-responsive mb-4">
                        <table id="purchase-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-purchase"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.Supplier')); ?></th>
                                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                                    <th><?php echo e(trans('file.product')); ?> (<?php echo e(trans('file.qty')); ?>)</th>
                                    <th><?php echo e(trans('file.grand total')); ?></th>
                                    <th><?php echo e(trans('file.Paid Amount')); ?></th>
                                    <th><?php echo e(trans('file.Due')); ?></th>
                                    <th><?php echo e(trans('file.Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_purchase_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key); ?></td>
                                    <?php 
                                        $warehouse = DB::table('warehouses')->find($purchase->warehouse_id);
                                        $supplier = DB::table('suppliers')->find($purchase->supplier_id);
                                    ?>
                                    <td><?php echo e(date($general_setting->date_format, strtotime($purchase->created_at->toDateString())) . ' '. $purchase->created_at->toTimeString()); ?></td>
                                    <td><?php echo e($purchase->reference_no); ?></td>
                                    <?php if($supplier): ?>
                                    <td><?php echo e($supplier->name); ?></td>
                                    <?php else: ?>
                                    <td>N/A</td>
                                    <?php endif; ?>
                                    <td><?php echo e($warehouse->name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $lims_product_purchase_data[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_purchase_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $product = App\Product::find($product_purchase_data->product_id);
                                            $unit = App\Unit::find($product_purchase_data->purchase_unit_id);
                                        ?>
                                        <?php if($unit): ?>
                                            <?php echo e($product->name.' ('.$product_purchase_data->qty.' '.$unit->unit_code.')'); ?>

                                        <?php else: ?>
                                            <?php echo e($product->name.' ('.$product_purchase_data->qty.')'); ?>

                                        <?php endif; ?>
                                        <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(number_format((float)($purchase->grand_total), 2, '.', '')); ?></td>
                                    <td><?php echo e(number_format((float)($purchase->paid_amount), 2, '.', '')); ?></td>
                                    <td><?php echo e(number_format((float)($purchase->grand_total - $purchase->paid_amount), 2, '.', '')); ?></td>
                                    <?php if($purchase->status == 1): ?>
				                       <td><div class="badge badge-success"><?php echo e(trans('file.Recieved')); ?></div></td>
				                    <?php elseif($purchase->status == 2): ?>
				                       <td><div class="badge badge-success"><?php echo e(trans('file.Partial')); ?></div></td>
				                    <?php elseif($purchase->status == 3): ?>
				                        <td><div class="badge badge-danger"><?php echo e(trans('file.Pending')); ?></div></td>
				                    <?php elseif($purchase->status == 4): ?>
				                        <td><div class="badge badge-danger"><?php echo e(trans('file.Ordered')); ?></div></td>
				                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-quotation">
                    <div class="table-responsive mb-4">
                        <table id="quotation-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-quotation"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.customer')); ?></th>
                                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                                    <th><?php echo e(trans('file.product')); ?> (<?php echo e(trans('file.qty')); ?>)</th>
                                    <th><?php echo e(trans('file.grand total')); ?></th>
                                    <th><?php echo e(trans('file.Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_quotation_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key); ?></td>
                                    <?php 
                                        $warehouse = DB::table('warehouses')->find($quotation->warehouse_id);
                                        $customer = DB::table('customers')->find($quotation->customer_id);
                                    ?>
                                    <td><?php echo e(date($general_setting->date_format, strtotime($quotation->created_at->toDateString())) . ' '. $quotation->created_at->toTimeString()); ?></td>
                                    <td><?php echo e($quotation->reference_no); ?></td>
                                    <td><?php echo e($customer->name); ?></td>
                                    <td><?php echo e($warehouse->name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $lims_product_quotation_data[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_quotation_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $product = App\Product::find($product_quotation_data->product_id);
                                            $unit = App\Unit::find($product_quotation_data->quotation_unit_id);
                                        ?>
                                        <?php if($unit): ?>
                                            <?php echo e($product->name.' ('.$product_quotation_data->qty.' '.$unit->unit_code.')'); ?>

                                        <?php else: ?>
                                            <?php echo e($product->name.' ('.$product_quotation_data->qty.')'); ?>

                                        <?php endif; ?>
                                        <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(number_format((float) $quotation->grand_total, 2, '.', '')); ?></td>
                                    
                                    <?php if($quotation->quotation_status == 2): ?>
                                    <td><div class="badge badge-success"><?php echo e(trans('file.Sent')); ?></div></td>
                                    <?php else: ?>
                                    <td><div class="badge badge-danger"><?php echo e(trans('file.Pending')); ?></div></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-transfer">
                    <div class="table-responsive mb-4">
                        <table id="transfer-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-transfer"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.From')); ?></th>
                                    <th><?php echo e(trans('file.To')); ?></th>
                                    <th><?php echo e(trans('file.product')); ?> (<?php echo e(trans('file.qty')); ?>)</th>
                                    <th><?php echo e(trans('file.grand total')); ?></th>
                                    <th><?php echo e(trans('file.Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_transfer_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key); ?></td>
                                    <?php 
                                        $from_warehouse = DB::table('warehouses')->find($transfer->from_warehouse_id);
                                        $to_warehouse = DB::table('warehouses')->find($transfer->to_warehouse_id);
                                    ?>
                                    <td><?php echo e(date($general_setting->date_format, strtotime($transfer->created_at->toDateString())) . ' '. $transfer->created_at->toTimeString()); ?></td>
                                    <td><?php echo e($transfer->reference_no); ?></td>
                                    <td><?php echo e($from_warehouse->name); ?></td>
                                    <td><?php echo e($to_warehouse->name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $lims_product_transfer_data[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_transfer_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $product = App\Product::find($product_transfer_data->product_id);
                                            $unit = App\Unit::find($product_transfer_data->transfer_unit_id);
                                        ?>
                                        <?php if($unit): ?>
                                            <?php echo e($product->name.' ('.$product_transfer_data->qty.' '.$unit->unit_code.')'); ?>

                                        <?php else: ?>
                                            <?php echo e($product->name.' ('.$product_transfer_data->qty.')'); ?>

                                        <?php endif; ?>
                                        <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(number_format((float) $transfer->grand_total, 2, '.', '')); ?></td>

                                    <?php if($transfer->status == 1): ?>
                                    <td><div class="badge badge-success"><?php echo e(trans('file.Completed')); ?></div></td>
                                    <?php elseif($transfer->status == 2): ?>
                                    <td><div class="badge badge-danger"><?php echo e(trans('file.Pending')); ?></div></td>
                                    <?php else: ?>
                                    <td><div class="badge badge-warning"><?php echo e(trans('file.Sent')); ?></div></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-payments">
                    <div class="table-responsive mb-4">
                        <table id="payment-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-payment"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.Amount')); ?></th>
                                    <th><?php echo e(trans('file.Paid Method')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_payment_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key); ?></td>
                                        <td><?php echo e(date($general_setting->date_format, strtotime($payment->created_at))); ?></td>
                                        <td><?php echo e($payment->payment_reference); ?></td>
                                        <td><?php echo e($payment->amount); ?></td>
                                        <td><?php echo e($payment->paying_method); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-expense">
                    <div class="table-responsive mb-4">
                        <table id="expense-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-expense"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                                    <th><?php echo e(trans('file.category')); ?></th>
                                    <th><?php echo e(trans('file.Amount')); ?></th>
                                    <th><?php echo e(trans('file.Note')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_expense_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php
                                            $warehouse = DB::table('warehouses')->find($expense->warehouse_id);
                                            $expense_category = DB::table('expense_categories')->find($expense->expense_category_id);
                                        ?>
                                        <td><?php echo e($key); ?></td>
                                        <td><?php echo e(date($general_setting->date_format, strtotime($expense->created_at))); ?></td>
                                        <td><?php echo e($expense->reference_no); ?></td>
                                        <td><?php echo e($warehouse->name); ?></td>
                                        <td><?php echo e($expense_category->name); ?></td>
                                        <td><?php echo e($expense->amount); ?></td>
                                        <td><?php echo e($expense->note); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="user-payroll">
                    <div class="table-responsive mb-4">
                        <table id="payroll-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="not-exported-payroll"></th>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.reference')); ?></th>
                                    <th><?php echo e(trans('file.Employee')); ?></th>
                                    <th><?php echo e(trans('file.Amount')); ?></th>
                                    <th><?php echo e(trans('file.Method')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lims_payroll_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php
                                            $employee = DB::table('employees')->find($payroll->employee_id);
                                        ?>
                                        <td><?php echo e($key); ?></td>
                                        <td><?php echo e(date($general_setting->date_format, strtotime($payroll->created_at))); ?></td>
                                        <td><?php echo e($payroll->reference_no); ?></td>
                                        <td><?php echo e($employee->name); ?></td>
                                        <td><?php echo e($payroll->amount); ?></td>
                                        <?php if($payroll->paying_method == 0): ?>
                                        <td>Cash</td>
                                        <?php elseif($payroll->paying_method == 1): ?>
                                        <td>Cheque</td>
                                        <?php else: ?>
                                        <td>Credit Card</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot class="tfoot active">
                                <tr>
                                    <th></th>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #user-report-menu").addClass("active");

    $('#user_id').val($('input[name="user_id_hidden"]').val());
    $('.selectpicker').selectpicker('refresh');

    $('#sale-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-sale)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_sale(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_sale(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-sale)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_sale(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_sale(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-sale)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_sale(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_sale(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_sale(api, false);
        }
    } );

    function datatable_sum_sale(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 7 ).footer() ).html(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            
            $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
            $( dt_selector.column( 7 ).footer() ).html(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

    $('#purchase-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-quotation)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_purchase(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_purchase(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_purchase(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_purchase(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_purchase(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_purchase(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_purchase(api, false);
        }
    } );

    function datatable_sum_purchase(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 7 ).footer() ).html(dt_selector.cells( rows, 7, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
            $( dt_selector.column( 7 ).footer() ).html(dt_selector.column( 7, {page:'current'} ).data().sum().toFixed(2));
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.column( 8, {page:'current'} ).data().sum().toFixed(2));
        }
    }

    $('#quotation-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-quotation)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_quotation(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_quotation(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-quotation)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_quotation(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_quotation(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-quotation)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_quotation(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_quotation(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_quotation(api, false);
        }
    } );

    function datatable_sum_quotation(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            
            $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
        }
    }

    $('#transfer-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-transfer)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_transfer(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_transfer(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-transfer)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_transfer(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_transfer(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-transfer)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_transfer(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_transfer(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_transfer(api, false);
        }
    } );

    function datatable_sum_transfer(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 6 ).footer() ).html(dt_selector.cells( rows, 6, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            
            $( dt_selector.column( 6 ).footer() ).html(dt_selector.column( 6, {page:'current'} ).data().sum().toFixed(2));
        }
    }

    $('#payment-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-payment)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payment(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_payment(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payment(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_payment(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payment(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_payment(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_payment(api, false);
        }
    } );

    function datatable_sum_payment(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 3 ).footer() ).html(dt_selector.column( 3, {page:'current'} ).data().sum().toFixed(2));
        }
    }

    $('#expense-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-expense)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_expense(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_expense(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_expense(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_expense(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_expense(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_expense(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_expense(api, false);
        }
    } );

    function datatable_sum_expense(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.column( 5, {page:'current'} ).data().sum().toFixed(2));
        }
    }

    $('#payroll-table').DataTable( {
        "order": [],
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': 0
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:Not(.not-exported-payroll)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payroll(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_payroll(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payroll(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum_payroll(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum_payroll(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum_payroll(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum_payroll(api, false);
        }
    } );

    function datatable_sum_payroll(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.column( 4, {page:'current'} ).data().sum().toFixed(2));
        }
    }

$(".daterangepicker-field").daterangepicker({
  callback: function(startDate, endDate, period){
    var start_date = startDate.format('YYYY-MM-DD');
    var end_date = endDate.format('YYYY-MM-DD');
    var title = start_date + ' To ' + end_date;
    $(this).val(title);
    $('input[name="start_date"]').val(start_date);
    $('input[name="end_date"]').val(end_date);
  }
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>