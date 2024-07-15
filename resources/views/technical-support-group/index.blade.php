@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')

    <x-paneltitle titleName="Grupos"></x-paneltitle>

    @if($groups->isNotEmpty())

            <div class="container-fluid table-responsive">
                <table id="users_table" class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Zona</th>
                            <th>Instaladores</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="users_plans_table_content">

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($groups as $group)

                            <tr>
                                <td class="align-middle">{{ $index }}</td>
                                <td class="align-middle">{{ $group->name }}</td>
                                <td class="align-middle">{{ $group->zone }}</td>
                                <td class="align-middle">{{ $group->user_names }}</td>
                                <td class="align-middle">

                                    <form
                                    method="POST"
                                    action="{{ route('technical-support-group.destroy', ['technicalSupportGroup' => $group]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </form>

                                </td>
                            </tr>

                        @php
                        $index++;
                        @endphp

                        @endforeach

                    </tbody>
                </table>
            </div>


  @else

    <div class="my-5 text-center">No hay informacion para mostrar</div>

  @endif

    <x-paneltitle titleName="Crear nuevo grupo"></x-paneltitle>

    <form method="POST" action="{{ route('technical-support-group.store') }}" >

        @csrf

        <div class="row">
            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Nombre del grupo</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="col-12 col-md-6">
                <label for="zone" class="form-label">Zona</label>
                <input type="text" id="zone" name="zone" class="form-control">
            </div>
        </div>

        <label class="form-label">Usuarios</label>

        <div id="technical-users-container">

            <div class="input-group mb-3 user-element">

              <div class="input-group-prepend">
                <span class="input-group-text" >Instalador</span>
              </div>

              <select class="custom-select" name="technical_support_user[]">
                <option value="">Seleccionar...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>

              <div class="input-group-append">
                <button class="btn btn-outline-secondary remove-user" type="button">Eliminar</button>
              </div>

            </div>

        </div>

        <div class="text-right">
            <button class="btn btn-primary" id="add-new-user-btn">Agregar</button>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary my-5">Crear Grupo</button>
        </div>

    </form>
@stop


@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/technical-support/installer-groups.js') }}"></script>
@endsection
