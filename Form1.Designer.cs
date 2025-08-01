namespace CaroLan
{
    partial class Form1
    {
        private System.ComponentModel.IContainer components = null;

        private System.Windows.Forms.Panel panelBoard;
        private System.Windows.Forms.Label lblTurn;
        private System.Windows.Forms.TextBox txtIP;
        private System.Windows.Forms.Button btnServer;
        private System.Windows.Forms.Button btnClient;
        private System.Windows.Forms.Button btnReset;

        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        private void InitializeComponent()
        {
            this.panelBoard = new System.Windows.Forms.Panel();
            this.lblTurn = new System.Windows.Forms.Label();
            this.txtIP = new System.Windows.Forms.TextBox();
            this.btnServer = new System.Windows.Forms.Button();
            this.btnClient = new System.Windows.Forms.Button();
            this.btnReset = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // panelBoard
            // 
            this.panelBoard.BackColor = System.Drawing.SystemColors.ControlLight;
            this.panelBoard.Location = new System.Drawing.Point(14, 13);
            this.panelBoard.Name = "panelBoard";
            this.panelBoard.Size = new System.Drawing.Size(617, 576);
            this.panelBoard.TabIndex = 0;
            // 
            // lblTurn
            // 
            this.lblTurn.AutoSize = true;
            this.lblTurn.Font = new System.Drawing.Font("Arial", 12F, System.Drawing.FontStyle.Bold);
            this.lblTurn.Location = new System.Drawing.Point(651, 21);
            this.lblTurn.Name = "lblTurn";
            this.lblTurn.Size = new System.Drawing.Size(83, 24);
            this.lblTurn.TabIndex = 1;
            this.lblTurn.Text = "Lượt: X";
            // 
            // txtIP
            // 
            this.txtIP.Font = new System.Drawing.Font("Arial", 10F);
            this.txtIP.Location = new System.Drawing.Point(651, 64);
            this.txtIP.Name = "txtIP";
            this.txtIP.Size = new System.Drawing.Size(205, 27);
            this.txtIP.TabIndex = 2;
            this.txtIP.Text = "127.0.0.1";
            // 
            // btnServer
            // 
            this.btnServer.Font = new System.Drawing.Font("Arial", 10F);
            this.btnServer.Location = new System.Drawing.Point(651, 107);
            this.btnServer.Name = "btnServer";
            this.btnServer.Size = new System.Drawing.Size(97, 32);
            this.btnServer.TabIndex = 3;
            this.btnServer.Text = "Tạo Server";
            this.btnServer.UseVisualStyleBackColor = true;
            this.btnServer.Click += new System.EventHandler(this.btnServer_Click);
            // 
            // btnClient
            // 
            this.btnClient.Font = new System.Drawing.Font("Arial", 10F);
            this.btnClient.Location = new System.Drawing.Point(760, 107);
            this.btnClient.Name = "btnClient";
            this.btnClient.Size = new System.Drawing.Size(97, 32);
            this.btnClient.TabIndex = 4;
            this.btnClient.Text = "Kết nối";
            this.btnClient.UseVisualStyleBackColor = true;
            this.btnClient.Click += new System.EventHandler(this.btnClient_Click);
            // 
            // btnReset
            // 
            this.btnReset.Font = new System.Drawing.Font("Arial", 10F);
            this.btnReset.Location = new System.Drawing.Point(651, 160);
            this.btnReset.Name = "btnReset";
            this.btnReset.Size = new System.Drawing.Size(206, 32);
            this.btnReset.TabIndex = 5;
            this.btnReset.Text = "Chơi lại";
            this.btnReset.UseVisualStyleBackColor = true;
            this.btnReset.Click += new System.EventHandler(this.btnReset_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(939, 608);
            this.Controls.Add(this.btnReset);
            this.Controls.Add(this.btnClient);
            this.Controls.Add(this.btnServer);
            this.Controls.Add(this.txtIP);
            this.Controls.Add(this.lblTurn);
            this.Controls.Add(this.panelBoard);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.Name = "Form1";
            this.Text = "Game Caro LAN";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Form1_FormClosing);
            this.Load += new System.EventHandler(this.Form1_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }
    }
}
