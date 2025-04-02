import 'package:flutter/material.dart';
import '../utils/vibrate.dart';

class VibrationTestPage extends StatelessWidget {
  const VibrationTestPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Teste de Vibrações'),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const SizedBox(height: 16),
              _buildSection('Tipos Básicos de Vibração'),
              _buildVibrationButton('Vibração Leve', Vibrate.light),
              _buildVibrationButton('Vibração Média', Vibrate.medium),
              _buildVibrationButton('Vibração Forte', Vibrate.heavy),
              _buildVibrationButton('Vibração de Seleção', Vibrate.selection),
              _buildVibrationButton('Vibração de Notificação', Vibrate.notification),
              
              const SizedBox(height: 32),
              _buildSection('Padrões para Elementos UI'),
              _buildVibrationButton('Padrão de Botão', Vibrate.button),
              _buildVibrationButton('Padrão de Seletor (Picker)', Vibrate.picker),
              _buildVibrationButton('Padrão de Alternador (Toggle)', Vibrate.toggle),
              
              const SizedBox(height: 32),
              _buildSection('Padrões de Feedback'),
              _buildVibrationButton('Padrão de Sucesso', Vibrate.success),
              _buildVibrationButton('Padrão de Erro', Vibrate.error),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildSection(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16.0),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.bold,
        ),
      ),
    );
  }

  Widget _buildVibrationButton(String label, VoidCallback onPressed) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 10.0),
      child: ElevatedButton(
        onPressed: () {
          onPressed();
        },
        style: ElevatedButton.styleFrom(
          padding: const EdgeInsets.symmetric(vertical: 16.0),
        ),
        child: Text(
          label,
          style: const TextStyle(fontSize: 16),
        ),
      ),
    );
  }
} 