<template>
    <div>        
        <div class="page-wrap d-flex flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <span class="display-1 d-block">404</span>
                        <div class="mb-4 lead">No se encontró la página que está buscando.</div>
                         <router-link
                            to="/"
                            class="nav-link"
                            :class="{ active: $route.name === 'home' }"
                            >
                            &nbsp;Home</router-link
                            >
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>