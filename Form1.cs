using System;
using System.Drawing;
using System.Threading; // Thêm để sử dụng Invoke
using System.Windows.Forms;
using CaroLan; // Để sử dụng được SocketManager nếu đặt trong cùng namespace


namespace CaroLan
{
    public partial class Form1 : Form
    {
        private const int boardSize = 18;
        private const int cellSize = 30;
        private Button[,] boardButtons;
        private bool isPlayerXTurn = true;

        private SocketManager socket;
        private bool isServer;
        private bool isMyTurn = true; // TRUE nếu người chơi được đánh



        public Form1()
        {
            InitializeComponent();
            DrawBoard();
        }

        private void DrawBoard()
        {
            panelBoard.Controls.Clear();
            boardButtons = new Button[boardSize, boardSize];

            for (int row = 0; row < boardSize; row++)
            {
                for (int col = 0; col < boardSize; col++)
                {
                    Button btn = new Button
                    {
                        Size = new Size(cellSize, cellSize),
                        Location = new Point(col * cellSize, row * cellSize),
                        Font = new Font("Arial", 14, FontStyle.Bold),
                        Tag = new Point(row, col)
                    };

                    btn.Click += Cell_Click;
                    panelBoard.Controls.Add(btn);
                    boardButtons[row, col] = btn;
                }
            }

            isPlayerXTurn = true;
            lblTurn.Text = "Lượt: X";
        }

        private void Cell_Click(object sender, EventArgs e)
        {
            if (!isMyTurn) return; // ❗ Nếu không tới lượt thì bỏ qua

            Button btn = sender as Button;
            if (btn == null || btn.Text != "") return;

            string currentMark = isPlayerXTurn ? "X" : "O";
            btn.Text = currentMark;
            btn.ForeColor = isPlayerXTurn ? Color.Red : Color.Blue;

            Point point = (Point)btn.Tag;

            // Gửi nước đi cho đối thủ
            socket?.Send($"{point.X},{point.Y}");

            if (CheckWin(point.X, point.Y, currentMark))
            {
                MessageBox.Show($"🎉 Người chơi {currentMark} thắng!", "Kết thúc", MessageBoxButtons.OK, MessageBoxIcon.Information);
                DisableBoard();
                return;
            }

            isMyTurn = false; // Sau khi đánh xong → chờ đối thủ
            isPlayerXTurn = !isPlayerXTurn;
            lblTurn.Text = isPlayerXTurn ? "Lượt: X" : "Lượt: O";
        }


        private bool CheckWin(int row, int col, string mark)
        {
            return CheckDirection(row, col, 1, 0, mark)    // Ngang
                || CheckDirection(row, col, 0, 1, mark)    // Dọc
                || CheckDirection(row, col, 1, 1, mark)    // Chéo chính
                || CheckDirection(row, col, 1, -1, mark);  // Chéo phụ
        }

        private bool CheckDirection(int row, int col, int dRow, int dCol, string mark)
        {
            int count = 1;

            // Kiểm tra một phía
            int r = row + dRow;
            int c = col + dCol;
            while (IsValid(r, c) && boardButtons[r, c].Text == mark)
            {
                count++;
                r += dRow;
                c += dCol;
            }

            // Kiểm tra phía ngược lại
            r = row - dRow;
            c = col - dCol;
            while (IsValid(r, c) && boardButtons[r, c].Text == mark)
            {
                count++;
                r -= dRow;
                c -= dCol;
            }

            return count >= 5;
        }

        private bool IsValid(int row, int col)
        {
            return row >= 0 && row < boardSize && col >= 0 && col < boardSize;
        }

        private void DisableBoard()
        {
            foreach (var btn in boardButtons)
            {
                btn.Enabled = false;
            }
        }

        private void btnReset_Click(object sender, EventArgs e)
        {
            DrawBoard();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            // Tuỳ chọn: bạn có thể tự động khởi tạo server hoặc client tại đây
            // Ví dụ:
            // StartServer(); hoặc ConnectToServer("127.0.0.1");
        }

        private void StartServer()
        {
            socket = new SocketManager();
            isServer = true;
            socket.CreateServer(9999);
            socket.DataReceived += Socket_DataReceived;
            isMyTurn = isServer; // Server được đi trước

        }

        private void ConnectToServer(string ip)
        {
            socket = new SocketManager();
            isServer = false;
            socket.ConnectToServer(ip, 9999);
            socket.DataReceived += Socket_DataReceived;
            isMyTurn = isServer; // Server được đi trước

        }

        private void Socket_DataReceived(string data)
        {
            this.Invoke(new MethodInvoker(() =>
            {
                string[] parts = data.Split(',');
                int row = int.Parse(parts[0]);
                int col = int.Parse(parts[1]);

                Button btn = boardButtons[row, col];
                if (btn.Text == "")
                {
                    string mark = isPlayerXTurn ? "X" : "O";
                    btn.Text = mark;
                    btn.ForeColor = isPlayerXTurn ? Color.Red : Color.Blue;

                    if (CheckWin(row, col, mark))
                    {
                        MessageBox.Show($"🎉 Người chơi {mark} thắng!", "Kết thúc", MessageBoxButtons.OK, MessageBoxIcon.Information);
                        DisableBoard();
                        return;
                    }

                    isPlayerXTurn = !isPlayerXTurn;
                    lblTurn.Text = isPlayerXTurn ? "Lượt: X" : "Lượt: O";
                    isMyTurn = true; // ✅ Sau khi nhận nước → tới lượt mình
                }
            }));
        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            socket?.Close();
        }
        private void btnServer_Click(object sender, EventArgs e)
        {
            StartServer();
            MessageBox.Show("🖥️ Đang chờ kết nối từ Client...", "Server", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

        private void btnClient_Click(object sender, EventArgs e)
        {
            string ip = txtIP.Text.Trim();
            if (string.IsNullOrEmpty(ip))
            {
                MessageBox.Show("Vui lòng nhập IP server!", "Lỗi", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            ConnectToServer(ip);
            MessageBox.Show("🔗 Đã kết nối tới server!", "Client", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

    }

}