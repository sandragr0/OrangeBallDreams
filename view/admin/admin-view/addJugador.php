<script src="../assets/js/addJugador.js"></script>


        <h1>Añadir jugador</h1>
        <form>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre<span data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obligatorio">*</span></label>
                <input type="text" class="form-control" id="nombre" required>
            </div>

            <!-- Apellido 1 -->
            <div class="mb-3">
                <label for="apellido1" class="form-label">Primer apellido*</label>
                <input type="text" class="form-control" id="apellido1" required>
            </div>

            <!-- Apellido 2 -->
            <div class="mb-3">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" id="apellido2">
            </div>

            <!-- Altura -->
            <div class="mb-3">
                <label for="altura" class="form-label">Altura</label>
                <input type="text" class="form-control" id="altura">
            </div>

            <!-- Extracomunitario -->
            <div class="mb-3">
                <label for="extracomunitario" class="form-label">Extracomunitario</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="extracomunitario" id="extracomSi" checked>
                    <label class="form-check-label" for="extracomSi">
                        Si
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="extracomunitario" id="extracomNo">
                    <label class="form-check-label" for="extracomNo">
                        No
                    </label>
                </div>
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNac">
                <div class="alert alert-danger mt-2 oculto" id="mensajeError6" role="alert"></div>
            </div>

            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="tel" class="form-control" id="telefono">
            </div> 

            <!-- Estado -->
            <div class="mb-3">
                <label for="extracomunitario" class="form-label">Estado</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="disponible" checked>
                    <label class="form-check-label" for="disponible">
                        Disponible
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="fichado">
                    <label class="form-check-label" for="fichado">
                        Fichado
                    </label>
                </div>
            </div>

            <!-- Biografia -->
            <div class="mb-3">
                <label for="biografia" class="form-label">Biografia</label>
                <textarea class="form-control" id="biografia" rows="3"></textarea>
            </div> 

            <!-- Informe -->
            <div class="mb-3">
                <label for="biografia" class="form-label">Informe</label>
                <textarea class="form-control" id="informe" rows="3"></textarea>
            </div> 

            <!-- Informe -->
            <div class="mb-3">
                <label for="equipo" class="form-label">Equipo</label>
                <select class="form-select" id="equipo">
                    <option selected>Seleccionar</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div> 


            <button type="submit" class="btn btn-secondary boton-primario">Añadir</button>
            <div class="alert alert-danger mt-2 oculto" id="mensajeError"role="alert"></div>
        </form>
</main>


</div>
</div>
</div>
</body>
</html>
