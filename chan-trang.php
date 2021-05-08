<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

 		<!-- jQuery -->

 		<script src="public/assets/js/jquery.min.js"></script>
 		<!-- Bootstrap JavaScript -->
 		<!-- Bootstrap core JavaScript-->

 		<script src="public/assets/js/bootstrap.min.js"></script>
 		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="public/assets/js/number-format.js"></script>

 		<script type="text/javascript" src="public/assets/js/angular.min.js"></script>
		<script type="text/javascript" src="public/assets/js/app.js"></script>

         <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/assets/demo/chart-area-demo.js"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/assets/demo/chart-bar-demo.js"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="startbootstrap-sb-admin-gh-pages/dist/assets/demo/datatables-demo.js"></script>
		
<!-- Hàm viết số có dấu ngăn cách -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('.price').number( true, 0 );
            })
        </script>
<!-- Hàm check trong chọn hàng hóa -->
 		<script type="text/javascript">
 			$('#select_all').click(function(){
 				var check = $(this).is(':checked');

 				if (check) {
 					$('.mhh').prop('checked',true);
 				}else{
 					$('.mhh').removeAttr('checked');
 				}
 			});
 		</script>
 	</body>
 </html> 

