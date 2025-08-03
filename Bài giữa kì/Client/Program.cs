using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Sockets;
using System.Text;
using System.Threading.Tasks;

namespace Client
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("My Client");
            TcpClient client = new TcpClient();
            client.Connect("127.0.0.1", 5000); // thay "127.0.0.1" bằng IP nội bộ của Server

            NetworkStream stream = client.GetStream();

            string message = "Hello from Client!";
            byte[] data = Encoding.UTF8.GetBytes(message);
            stream.Write(data, 0, data.Length);

            // Nhận phản hồi từ server
            byte[] buffer = new byte[1024];
            int bytesRead = stream.Read(buffer, 0, buffer.Length);
            string response = Encoding.UTF8.GetString(buffer, 0, bytesRead);
            Console.WriteLine("Received from server: " + response);

            client.Close();
            Console.ReadKey();
        }
    }
}
