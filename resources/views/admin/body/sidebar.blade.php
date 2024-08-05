  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  {{-- <img src="{{ asset('assets/logo3.png') }}" width="70" alt=""> --}}
						  <h3><b>Nyapi</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li>
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>
        <li>
            <a href="{{ route('admin.alltransactions') }}">
              <i data-feather="clock"></i>
              <span>Riwayat Pesanan</span>
            </a>
          </li>
        <li>
            <a href="{{ route('admin.add_product') }}">
              <i data-feather="plus"></i>
              <span>Add Product</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.beritas.create') }}">
              <i data-feather="plus"></i>
              <span>Add Berita</span>
            </a>
          </li>

      </ul>
    </section>

  </aside>
