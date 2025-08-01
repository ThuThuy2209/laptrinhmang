using System;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Threading;

namespace CaroLan
{
    public class SocketManager
    {
        private TcpListener server;
        private TcpClient client;
        private NetworkStream stream;

        public event Action<string> DataReceived;

        public void CreateServer(int port)
        {
            server = new TcpListener(IPAddress.Any, port);
            server.Start();
            Thread thread = new Thread(() =>
            {
                client = server.AcceptTcpClient();
                stream = client.GetStream();
                Listen();
            });
            thread.IsBackground = true;
            thread.Start();
        }

        public void ConnectToServer(string ip, int port)
        {
            client = new TcpClient();
            client.Connect(IPAddress.Parse(ip), port);
            stream = client.GetStream();
            Thread thread = new Thread(Listen);
            thread.IsBackground = true;
            thread.Start();
        }

        public void Send(string message)
        {
            if (stream != null && stream.CanWrite)
            {
                byte[] data = Encoding.UTF8.GetBytes(message);
                stream.Write(data, 0, data.Length);
            }
        }

        private void Listen()
        {
            byte[] buffer = new byte[1024];
            while (client != null && client.Connected)
            {
                try
                {
                    int bytes = stream.Read(buffer, 0, buffer.Length);
                    if (bytes > 0)
                    {
                        string message = Encoding.UTF8.GetString(buffer, 0, bytes);
                        DataReceived?.Invoke(message);
                    }
                }
                catch (Exception ex)
                {
                    Console.WriteLine("Lỗi khi nhận dữ liệu: " + ex.Message);
                    break;
                }
            }
        }


        public void Close()
        {
            stream?.Close();
            client?.Close();
            server?.Stop();
        }
    }
}
