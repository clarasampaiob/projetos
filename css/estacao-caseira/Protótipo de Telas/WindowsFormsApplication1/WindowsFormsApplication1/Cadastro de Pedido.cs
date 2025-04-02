using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApplication1
{
    public partial class Cadastro_de_Pedido : Form
    {
        public Cadastro_de_Pedido()
        {
            InitializeComponent();
        }

        private void label7_Click(object sender, EventArgs e)
        {

        }

        private void textBox7_TextChanged(object sender, EventArgs e)
        {

        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            
            if (comboBox1.Text == "Marmita 1") {
                textBox3.Text = "R$ 15,00";
                textBox2.Text = "Arroz, feijão, bife e salada de tomate";
            }
            if (comboBox1.Text == "Marmita 2")
            {
                textBox3.Text = "R$ 18,00";
                textBox2.Text = "Arroz, feijão, bife e ovo frito";
            }
            if (comboBox1.Text == "Marmita 3")
            {
                textBox3.Text = "R$ 14,00";
                textBox2.Text = "Arroz, feijão, file de frango, creme de milho";
            }
            if (comboBox1.Text == "Marmita 4")
            {
                textBox3.Text = "R$ 10,00";
                textBox2.Text = "Arroz, feijão, file de frango e salada de tomate";
            }
        }
    }
}
