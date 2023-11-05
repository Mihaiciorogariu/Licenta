using System;
using System.Device.Gpio;
using System.Diagnostics;
using System.Net;
using System.Threading;
using System.Threading.Tasks;
using Unosquare.RaspberryIO;
using Unosquare.RaspberryIO.Peripherals;
using System;
using Unosquare.RaspberryIO.Abstractions;
using Unosquare.RaspberryIO.Peripherals;
using Unosquare.WiringPi;
namespace LicentaPI
{
    

    class Program
    {
        // public static int pinTempartura = 6; //GPIO 6
       
        static void Main(string[] args)
        {
            Pi.Init<BootstrapWiringPi>();  // Initialize the connection with Raspberry Pi through the GPIO
            Console.Clear();
            using var sensor = DhtSensor.Create(DhtType.Dht11, Pi.Gpio[Unosquare.RaspberryIO.Abstractions.BcmPin.Gpio06]); // GPIO 6
            
            sensor.OnDataAvailable += (s, e) =>  // Send data when a different value is detected. Handler de evenimente
            // +=: Inregistreaza handler de eveniment (functia este chemata cand evenimentul se intampla)
            // S=Sender (Controleaza libraria de control a senzorului (Codul de control a senzorului))(This -> Acces la obiectul care a apelat evenimentul: Libraria de control a senzorului)
            // E=Events
            // E -> IsValid (True daca datele sunt citite / False daca datele nu au putut fi citite)
            // When the sensor (s -> object) has new data, it triggers the event => The GET request is sent
            {
                if (!e.IsValid) // Citirle invalide se ignora
                    return;
             
                using (WebClient client = new WebClient()) // Se instantiaza un HTTP client care apeleaza scriptul set_senzors, caruia ii trimite
                                                            // temperatura primita de la libraria de control a senzorului
                {
                    string downloadString = client.DownloadString($"http://parking.local/Web_Licenta/set_sensors.php?id_sensor=1&value={e.Temperature}");
                }
                using (WebClient client = new WebClient())
                {
                    string downloadString = client.DownloadString($"http://parking.local/Web_Licenta/set_sensors.php?id_sensor=3&value={e.HumidityPercentage:P0}");
                }
            };

            sensor.Start();

            while (true) // Nu lasa senzorul sa se opreasca din citit
                        // Mentine firul de executie principal activ, pentru ca cel secundar (libraria) sa functioneze
            {
                
            }
          
        }
    }
}
