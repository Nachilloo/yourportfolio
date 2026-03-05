/**
 * Cursor 3D Tubes Effect - Versión Definitiva
 * Se ejecuta como módulo ES6
 */

// Función para generar colores aleatorios
const randomHexColor = () => {
    return '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
};

// Función principal asíncrona
(async function initTubesCursor() {
    try {
        // 1. Buscar el canvas
        const canvas = document.getElementById('cursor-canvas');
        if (!canvas) {
            console.warn('Canvas #cursor-canvas no encontrado');
            return;
        }

        // 2. Importar la librería DINÁMICAMENTE
        const module = await import('https://cdn.jsdelivr.net/npm/threejs-components@0.0.19/build/cursors/tubes1.min.js');
        const TubesCursor = module.default || module;

        // 3. Configuración de colores (personaliza aquí)
        const config = {
            tubes: {
                colors: ["#f967fb", "#53bc28", "#6958d5"], // Cambia por tus colores
                lights: {
                    intensity: 200,
                    colors: ["#83f36e", "#fe8a2e", "#ff008a", "#60aed5"]
                }
            }
        };

        // 4. Inicializar el efecto
        const app = TubesCursor(canvas, config);
        
        if (!app) {
            console.error('No se pudo inicializar TubesCursor');
            return;
        }

        console.log('✅ Efecto 3D inicializado correctamente');

        // 5. Cambio de color al hacer clic (opcional)
        document.body.addEventListener('click', () => {
            if (app.tubes?.setColors) {
                app.tubes.setColors([randomHexColor(), randomHexColor(), randomHexColor()]);
            }
            if (app.tubes?.lights?.setColors) {
                app.tubes.lights.setColors([
                    randomHexColor(), randomHexColor(), 
                    randomHexColor(), randomHexColor()
                ]);
            }
        });

        // 6. Ajuste para cuando la página cambia (Página completa)
        window.addEventListener('resize', () => {
            // El canvas ya es fixed, pero forzamos actualización
            canvas.style.width = '100vw';
            canvas.style.height = '100vh';
        });

    } catch (error) {
        console.error('❌ Error cargando el efecto 3D:', error);
    }
})();