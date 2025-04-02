import 'package:flutter/services.dart';

/// Utilitário para gerenciar efeitos de vibração/hapticos
class Vibrate {
  /// Vibração leve - feedback sutil para seleções e toques gerais
  static void light() {
    HapticFeedback.lightImpact();
  }

  /// Vibração média - feedback moderado para ações importantes
  static void medium() {
    HapticFeedback.mediumImpact();
  }

  /// Vibração forte - feedback intenso para mudanças ou ações críticas
  static void heavy() {
    HapticFeedback.heavyImpact();
  }

  /// Vibração de seleção - usado quando um item é selecionado
  /// Similar ao feedback fornecido ao selecionar itens em listas
  static void selection() {
    HapticFeedback.selectionClick();
  }

  /// Vibração padrão - vibração típica como de notificações
  static void notification() {
    HapticFeedback.vibrate();
  }

  /// Padrão de vibração para botões
  /// Fornece feedback leve ao pressionar botões
  static void button() {
    light();
  }

  /// Padrão de vibração para seleção de valores em seletores (como TimePicker/DatePicker)
  /// Feedback para quando um valor é escolhido em um seletor
  static void picker() {
    selection();
  }

  /// Padrão de vibração para alternar opções (como switches ou toggles)
  /// Feedback para indicar uma mudança de estado
  static void toggle() {
    medium();
  }

  /// Padrão de vibração para sucesso
  /// Feedback positivo para confirmações ou operações bem-sucedidas
  static void success() {
    const pattern = <int>[50, 100, 50, 100];
    _customVibrate(pattern);
  }

  /// Padrão de vibração para erro ou alerta
  /// Feedback mais forte para indicar problemas ou atenção necessária
  static void error() {
    heavy();
    Future.delayed(const Duration(milliseconds: 100), () => heavy());
  }

  /// Função para criar padrões personalizados de vibração
  /// Recebe uma lista de durações em milissegundos, alternando entre vibração e pausa
  static void _customVibrate(List<int> pattern) {
    // Atualmente não é possível criar facilmente padrões personalizados com HapticFeedback,
    // então simulamos com pausas e vibrações individuais
    for (int i = 0; i < pattern.length; i += 2) {
      if (i < pattern.length) {
        Future.delayed(Duration(milliseconds: _sumList(pattern, 0, i)), () {
          HapticFeedback.vibrate();
        });
      }
    }
  }

  /// Função auxiliar para somar elementos de uma lista até um índice específico
  static int _sumList(List<int> list, int start, int end) {
    int sum = 0;
    for (int i = start; i < end && i < list.length; i++) {
      sum += list[i];
    }
    return sum;
  }
} 