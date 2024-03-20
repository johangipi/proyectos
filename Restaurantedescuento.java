
import java.util.Scanner;

public class Restaurantedescuento {
     public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        // Input: Obtener el monto de la compra del cliente
        System.out.print("Ingrese el monto de la compra: ");
        double montoCompra = scanner.nextDouble();

        // Calcular el descuento basado en el monto de la compra
        double descuento = 0;
        if (montoCompra >= 200000) {
            descuento = 0.15;
        } else if (montoCompra >= 50000) {
            descuento = 0.02;
        } else if (montoCompra >= 20000) {
            descuento = 0.015;
        }

        // Calcular el valor del descuento
        double valorDescuento = montoCompra * descuento;

        // Calcular el monto total a pagar
        double montoTotal = montoCompra - valorDescuento;

        // Input: Obtener el nombre del cliente
        System.out.print("Ingrese su nombre: ");
        String nombreCliente = scanner.next();

        // Imprimir la factura
        System.out.println("\n--- Factura del Restaurante ---");
        System.out.println("Cliente: " + nombreCliente);
        System.out.println("Monto de la Compra: $" + montoCompra);
        System.out.println("Descuento: $" + valorDescuento);
        System.out.println("Total a Pagar: $" + montoTotal);
        System.out.println("\n¡Gracias por su visita!");

        // Cerrar el scanner
        scanner.close();
    }
}
