@extends('layouts.app')

@section('content')
<div class="content-wrapper completo">
  <!-- Content Header -->
  <div class="content-header titular">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 text-center">
          <h2 class="text-white">Bienvenido, {{ Auth::user()->name }}</h2>
          <p class="text-muted">Este es tu panel de vendedor</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Métricas -->
      <div class="row">
        <!-- Subastas Activas -->
        <div class="col-lg-3 col-6">
          <div class="small-box targeticas">
            <div class="inner">
              <h3>0</h3>
              <p>Subastas Activas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
              Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Subastas Registradas -->
        <div class="col-lg-3 col-6">
          <div class="small-box card-green targeticas">
            <div class="inner">
              <h3>0</h3>
              <p>Subastas Registradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>



        <!-- Subastas Finalizadas -->
        <div class="col-lg-3 col-6">
          <div class="small-box card-yellow targeticas">
            <div class="inner">
              <h3>0</h3>
              <p>Subastas Finalizadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-circled"></i>
            </div>
            <a href="#" class="small-box-footer">
              Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Subastas Inactivas -->
        <div class="col-lg-3 col-6">
          <div class="small-box card-red targeticas">
            <div class="inner">
              <h3>0</h3>
              <p>Subastas Inactivas</p>
            </div>
            <div class="icon">
              <i class="ion ion-close-circled"></i>
            </div>
            <a href="#" class="small-box-footer">
              Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
      <livewire:contador />

      <!-- Opcional: Últimas subastas publicadas -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title">Tus últimas subastas</h3>
            </div>
            <div class="card-body">
              <p class="text-muted">Aquí aparecerán tus últimas subastas creadas.</p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Ejemplo de producto</td>
                    <td><span class="badge bg-success">Activa</span></td>
                    <td>01/10/2025</td>
                    <td><a href="#" class="btn btn-sm btn-primary">Ver</a></td>
                  </tr>
                  <tr>
                    <td>Otro producto</td>
                    <td><span class="badge bg-warning">Finalizada</span></td>
                    <td>28/09/2025</td>
                    <td><a href="#" class="btn btn-sm btn-secondary">Ver</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection