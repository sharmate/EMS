<div class="sidebar-nav navbar-collapse">
	<ul class="nav" id="side-menu">
	   	<?php
			if ($_SESSION ['role'] == "admin") 
			{
		?>
	    
	    <li class="active">
    	    <a href="employeeList.php" class="anchor-btn">
    	    	<i class="fa fa-users"></i>&nbsp;&nbsp;Employee List
    		</a>
		</li>

		<li class="active">
			<a href="annual-outing-suggestions-admin.php" class="anchor-btn">
				<i class="fa fa-hand-peace-o"></i>&nbsp;&nbsp;Annual Outing Confirmation
			</a>
		</li>

		<li class="active">
			<a href="tshirt-suggestions-admin.php" class="anchor-btn">
				<i class="fa fa-user-secret"></i>&nbsp;&nbsp;T-Shirts Sizes
			</a>
		</li>

		<li class="active">
			<a href="expense-view-admin.php" class="anchor-btn">
				<i class="fa fa-money"></i>&nbsp;&nbsp;Expenses Sheet
			</a>
		</li>
		
		<li class="active">
			<a href="laptop-list-admin.php" class="anchor-btn">
				<i class="fa fa-laptop"></i>&nbsp;&nbsp;Laptop List
			</a>
		</li>
		
		<li class="active hidden">
			<a href="view-suggestion-list-admin.php" class="anchor-btn">
				<i class="fa fa-envelope"></i>&nbsp;&nbsp;Suggestion List
			</a>
		</li>
		
		<li class="active">
			<a href="expense_policy.php" class="anchor-btn">
				<i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;Expense Policy
			</a>
		</li>
		
		
<!-- 		</a></li> -->
		
		<!-- <li class="active"><a href="personal_info.php" class="anchor-btn"> <i 
				class="fa fa-user"></i>&nbsp;&nbsp;Personal Information		
		</a></li> -->

	    <li class="active">
			<a href="employeeAttendanceList.php" class="anchor-btn">
				<i class="fa fa-users"></i>&nbsp;&nbsp;Emp Attendance List
			</a>
		</li>
		
		
		<li class="active">
			<a href="view-suggestion-list-admin-copy.php" class="anchor-btn">
				<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Suggestion List
			</a>
		</li>
		
		<li class="active">
			<a href="view-tyaco-upload-profile-admin.php" class="anchor-btn">
				<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;User Applied List
			</a>
		</li>
		<li class="active">
			<a href="view-tyaco-user-enquiry-admin.php" class="anchor-btn">
				<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;User Enquiry List
			</a>
		</li>
		<li class="active">
			<a href="view-tyaco-user-request-admin.php" class="anchor-btn">
				<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;User Request List
			</a>
		</li>
		
		
	    <?php
			} 
			else
			{
		?>
	                                
	    <li style="background-color: #fff;"><a href="view.php"
			class="anchor-btn"> <i class="fa fa-barcode"></i>&nbsp;&nbsp;Attendance
		</a></li>

		<li style="background-color: #fff;"><a
			href="annual-outing-suggestion.php" class="anchor-btn"> <i
				class="fa fa-hand-peace-o"></i>&nbsp;&nbsp;Annual Outing Confirmation
		</a></li>

		<li style="background-color: #fff;"><a href="tshirt-suggestion.php"
			class="anchor-btn"> <i class="fa fa-user-secret"></i>&nbsp;&nbsp;My
				T-Shirt Size
		</a></li>

		<li class="active"><a href="expenses_view.php" class="anchor-btn"> <i
				class="fa fa-money"></i>&nbsp;&nbsp;Expenses Sheet
		</a></li>

		<li class="active"><a href="personal_info.php"
			class="anchor-btn"> <i class="fa fa-user"></i>&nbsp;&nbsp;Personal Information		
		</a></li>
		
		<li class="active"><a href="laptop-verification.php"
			class="anchor-btn"> <i class="fa fa-laptop"></i>&nbsp;&nbsp;Laptop Verification		
		</a></li>
		
		
		<li class="active hidden"><a href="all-view-suggestion-history-user.php"
			class="anchor-btn"> <i class="fa fa-history"></i>&nbsp;&nbsp;Suggestion History		
		</a></li>
		
		
		<li class="active"><a href="expense_policy.php"
			class="anchor-btn"> <i class="fa fa-balance-scale" aria-hidden="true"></i>&nbsp;&nbsp;Expense Policy	
		</a></li>
		
		<li class="active hidden"><a href="add-suggestion-box.php"
			class="anchor-btn"> <i class="fa fa-envelope"></i>&nbsp;&nbsp;Add Suggestion Box		
		</a></li>
		
		<li class="active"><a href="view-suggestion-list-user-copy.php"
			class="anchor-btn"> <i class="fa fa-envelope"></i>&nbsp;&nbsp;Suggestion List		
		</a></li>
<!-- 		<li class="active"><a href="view-confirm-outing.php" -->
<!-- 			class="anchor-btn"> <i class="fa fa-hand-peace-o" aria-hidden="true"></i>&nbsp;&nbsp;Confirm Outing	 -->
<!-- 		</a></li> -->

		<!-- <li class="active"><a href="personal_info.php" class="anchor-btn"> <i 
				class="fa fa-user"></i>&nbsp;&nbsp;Personal Information		
		</a></li> -->

	    <?php
			}
		?>
    </ul>
</div>