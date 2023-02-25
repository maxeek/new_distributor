<template>
    <div>
        <h1>Bienvenido a mi aplicación</h1>
        <p>¡Gracias por usar mi aplicación de Laravel con Inertia y Spatie!</p>
        <p><a href="{{ route('login') }}">Iniciar sesión</a></p>
    </div>
</template>
  
<script>
export default {
    name: "Home",
};
</script>
  