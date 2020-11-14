  {{$Modo == 'crear' ? 'Agregar empleado' : 'Modificar Empleado'}}  
    
    
    <div class="form-group">

        <label for="Nombre">{{'Nombre'}}</label>
        <input type="text" name="Nombre"  class="form-control {{ $errors -> has('Nombre') ? 'is-invalid' : '' }}" id="Nombre"

        value="{{ isset($empleado -> Nombre) ? $empleado -> Nombre:old('Nombre') }}"
        >

        {!! $errors -> first('Nombre', 
        '<div class="invalid-feedback">
            :message
        </div>')!!}
        
    </div>
  

    <br>

    <div class="form-group">
        <label for="ApellidoPaterno">{{'Apellido Paterno'}}</label>
        <input type="text" name="ApellidoPaterno"  class="form-control {{ $errors -> has('ApellidoPaterno') ? 'is-invalid' : '' }}" id="ApellidoPaterno" 

        value="{{ isset($empleado -> ApellidoPaterno) ? $empleado -> ApellidoPaterno : old('ApellidoPaterno') }}"

        >
        
        {!! $errors -> first('ApellidoPaterno', 
        '<div class="invalid-feedback">
            :message
        </div>')!!}
    </div>

    <br>

    <div class="form-group">

        <label for="ApellidoMaterno">{{'Apellido Materno'}}</label>
        <input type="text" name="ApellidoMaterno"  class="form-control {{ $errors -> has('ApellidoMaterno') ? 'is-invalid' : '' }}" id="ApellidoMaterno" 

            value="{{ isset($empleado -> ApellidoMaterno) ?  $empleado -> ApellidoMaterno : old('ApellidoMaterno') }}"
        >
        
        {!! $errors -> first('ApellidoMaterno', 
        '<div class="invalid-feedback">
            :message
        </div>')!!}
    </div>

    <br>

    <div class="form-group">
        <label for="Correo">{{'Correo'}}</label>
        <input type="mail" name="Correo" class="form-control {{ $errors -> has('Correo') ? 'is-invalid' : '' }}" id="Correo" 

        value="{{ isset($empleado -> Correo) ? $empleado -> Correo : old('Correo') }}"

        >
        {!! $errors -> first('Correo', 
        '<div class="invalid-feedback">
            :message
        </div>')!!}
    </div>


    <br/>
    <div class="form-group">

        @if(isset($empleado -> Foto))

            <img src="{{asset('storage').'/'.$empleado -> Foto}}" alt="" width="200" />        

    
        @endif
        <label for="foto">{{'Foto'}}</label>
    </div>

        <br>

        <input type="file" name="Foto" id="Foto" >

    <input type="submit" 

        value="{{$Modo == 'crear' ? 'Crear' : 'Modificar'}}"
    >