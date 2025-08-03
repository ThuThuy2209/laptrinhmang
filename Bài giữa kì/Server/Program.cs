using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Threading.Tasks;

namespace Server
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("My Server - Waiting for client..");

            TcpListener server = new TcpListener(IPAddress.Any, 5000);
            server.Start();

            TcpClient client = server.AcceptTcpClient();
            Console.WriteLine("Client connected!");

            NetworkStream stream = client.GetStream();

            byte[] buffer = new byte[1024];
            int bytesRead = stream.Read(buffer, 0, buffer.Length);
            string message = Encoding.UTF8.GetString(buffer, 0, bytesRead);

            //gửi phản hồi lại
            string reply = "Hello from Server!";
            byte[] replyBytes = Encoding.UTF8.GetBytes(reply);
            stream.Write(replyBytes, 0, replyBytes.Length);

            client.Close();
            server.Stop();
            Console.ReadKey();
        }
    }
}
