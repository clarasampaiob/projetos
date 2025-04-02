import 'package:flutter/material.dart';
import 'notifications.dart';
import 'dart:math';
import 'pages/vibration_test_page.dart';

class NotificationScreen extends StatelessWidget {
  NotificationScreen({super.key});

  // Listas de frases para títulos e corpos de notificações
  final List<String> notificationTitles = [
    'Hora de estudar!',
    'Vamos lá, foco nos estudos!',
    'Seu momento de aprendizado chegou!',
  ];

  final List<String> notificationBodies = [
    'É hora de se dedicar aos estudos e alcançar seus objetivos!',
    'O conhecimento te espera, vamos começar?',
    'Não deixe para depois, o futuro começa agora!',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Notificações'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            ElevatedButton(
              onPressed: () {
                NotificationService.showInstantNotification(
                  title: 'Notificação Instantânea',
                  body: 'Esta é uma notificação instantânea!',
                );
              },
              child: const Text('Mostrar Notificação Instantânea'),
            ),
            const SizedBox(height: 40),
            ElevatedButton(
              onPressed: () {
                showNotificationBottomSheet(context);
              },
              child: const Text('Modal Agendamento'),
            ),
            const SizedBox(height: 40),
            ElevatedButton(
              onPressed: () {
                NotificationService.printScheduledNotifications();
              },
              child: const Text('Ver Notificações Console'),
            ),
            ElevatedButton(
              onPressed: () {
                NotificationService.removeChanelNotifications('student');
              },
              child: const Text('Remover Notificações do Aluno'),
            ),
            ElevatedButton(
              onPressed: () {
                NotificationService.showScheduledNotificationsModal(context);
              },
              child: Text("Mostrar Notificações Agendadas"),
            ),
            const SizedBox(height: 40),
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => const VibrationTestPage(),
                  ),
                );
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.purple,
                foregroundColor: Colors.white,
              ),
              child: const Text('Testar Vibrações'),
            ),
          ],
        ),
      ),
    );
  }


  

void showNotificationBottomSheet(BuildContext context) {
  int id = Random().nextInt(100000);
  String title = notificationTitles[Random().nextInt(notificationTitles.length)];
  String body = notificationBodies[Random().nextInt(notificationBodies.length)];
  int? hour = 0;
  int? minute = 0;
  bool repeat = true;
  int? weekday; // Adicionado para armazenar o dia da semana



  showModalBottomSheet(
    context: context,
    isScrollControlled: true,
    backgroundColor: Colors.white,
    shape: const RoundedRectangleBorder(
      borderRadius: BorderRadius.vertical(top: Radius.circular(16)),
    ),
    constraints: BoxConstraints(
      maxHeight: MediaQuery.of(context).size.height * 0.9, 
    ),
    builder: (context) {
      return StatefulBuilder(
        builder: (context, setState) {
          return Column( 
            mainAxisSize: MainAxisSize.min,
            children: <Widget>[
              Expanded( 
                child: SingleChildScrollView(
                  child: Container(
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Align(
                          alignment: Alignment.topRight,
                          child: IconButton(
                            icon: const Icon(Icons.close),
                            onPressed: () => Navigator.of(context).pop(),
                          ),
                        ),
                        Center(
                          child: Padding(
                            padding: const EdgeInsets.only(bottom: 8.0), 
                            child: const Text(
                              'Notificação',
                              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                            ),
                          ),
                        ),
                        const SizedBox(height: 20),
                        GestureDetector(
                          onTap: () async {
                            TimeOfDay? pickedTime = await showTimePicker(
                              context: context,
                              initialTime: TimeOfDay(hour: hour ?? 8, minute: minute ?? 0),
                              cancelText: 'Fechar', // Altera o texto do botão "Cancelar"
                              confirmText: 'Confirmar', // Altera o texto do botão "OK"
                              helpText: 'Escolha um horário', // Altera o texto de ajuda
                              hourLabelText: 'Horas',
                              minuteLabelText: 'Minutos',
                              builder: (BuildContext context, Widget? child) {
                                return Theme(
                                  data: ThemeData.light().copyWith(
                                    colorScheme: ColorScheme.light(primary: Colors.green),
                                    timePickerTheme: TimePickerThemeData(
                                      backgroundColor: Colors.grey[100],
                                      hourMinuteTextColor: Colors.black,
                                      hourMinuteShape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                                      dayPeriodTextColor: Colors.black,
                                      dayPeriodShape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                                      dialTextColor: Colors.black,
                                      dialBackgroundColor: Colors.grey[200],
                                      entryModeIconColor: Colors.green,
                                      helpTextStyle: TextStyle(color: Colors.grey),
                                      hourMinuteTextStyle: TextStyle(fontSize: 40),
                                      dayPeriodTextStyle: TextStyle(fontSize: 12),
                                      dialTextStyle: TextStyle(fontSize: 20),
                                    ),
                                  ),
                                  child: child!,
                                );
                              },
                            );

                            if (pickedTime != null) {
                              setState(() {
                                hour = pickedTime.hour;
                                minute = pickedTime.minute;
                              });
                            }
                          },
                          child: _buildSelectableField(
                            label: "Selecionar Horário",
                            value: "${hour.toString().padLeft(2, '0')}:${minute.toString().padLeft(2, '0')}",
                          ),
                        ),
                        const SizedBox(height: 10),
                        GestureDetector(
                          onTap: () async {
                            int? pickedWeekday = await _showDayPicker(context, weekday);
                            if (pickedWeekday != null || pickedWeekday == null) {
                              setState(() {
                                weekday = pickedWeekday;
                              });
                            }
                          },
                          child: _buildSelectableField( 
                            label: "Selecionar Frequência",
                            value: weekday == null ? "Todos os dias" : _getDayShortName(weekday!),
                          ),
                        ),
                        const SizedBox(height: 10),
                        GestureDetector(
                          onTap: () {
                            setState(() {
                              repeat = !repeat;
                            });
                          },
                          child: Container(
                            padding: const EdgeInsets.symmetric(vertical: 14, horizontal: 12),
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(8),
                            ),
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Text(
                                  'Repetir',
                                  style: TextStyle(fontSize: 16, color: Colors.grey.shade600),
                                ),
                                Text(
                                  repeat ? 'Sim' : 'Não',
                                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.w500),
                                ),
                              ],
                            ),
                          ),
                        ),
                        const SizedBox(height: 20),
                      ],
                    ),
                  ),
                ),
              ),
              Padding( 
                padding: const EdgeInsets.symmetric(horizontal: 20).copyWith(bottom: 8), 
                child: Container(
                  decoration: BoxDecoration(
                    border: Border.all(color: Colors.grey.shade300),
                    borderRadius: BorderRadius.circular(8),
                    color: Colors.grey.shade100,
                  ),
                  padding: const EdgeInsets.all(12),
                  child: RichText( 
                    textAlign: TextAlign.justify,
                    text: TextSpan(
                      children: [
                        WidgetSpan( 
                          child: Padding(
                            padding: const EdgeInsets.only(right: 8), 
                            child: Icon(
                              Icons.warning_outlined,
                              color: Colors.orange,
                              size: 22,
                            ),
                          ),
                        ),
                        TextSpan( // TextSpan para o texto
                          text: 'Para garantir que as notificações sejam exibidas, permita o uso em segundo plano deste aplicativo.',
                          style: const TextStyle(fontSize: 20, color: Colors.black), // Estilo do texto
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              Container( //Btn Agendar Notificação
                padding: const EdgeInsets.all(16.0),
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green,
                    foregroundColor: Colors.white,
                    minimumSize: const Size(double.infinity, 50),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                  ),
                  onPressed: () {
                    if (hour == null || minute == null) {
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(content: Text("Por favor, selecione um horário!")),
                      );
                      return;
                    }

                    NotificationService.scheduleDailyStudyNotification(
                      id: id,
                      title: title,
                      body: body,
                      hour: hour!,
                      minute: minute!,
                      repeat: repeat,
                      weekday: weekday,
                    );
                    Navigator.of(context).pop();
                  },
                  child: const Text('Agendar Notificação'),
                ),
              ),
            ],
          );
        },
      );
    },
  );
}


// Campo clicável para seleção de horário
Widget _buildSelectableField({required String label, required String value}) {
  return Container(
    padding: const EdgeInsets.symmetric(vertical: 14, horizontal: 12),
    decoration: BoxDecoration(
      borderRadius: BorderRadius.circular(8),
    ),
    child: Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(
          label,
          style: TextStyle(fontSize: 16, color: Colors.grey.shade600),
        ),
        Text(
          value,
          style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w500),
        ),
      ],
    ),
  );
}




Future<int?> _showDayPicker(BuildContext context, int? currentWeekday) async {
  int? selectedDay = currentWeekday;

  return await showDialog<int?>(
    context: context,
    builder: (BuildContext context) {
      return StatefulBuilder(
        builder: (context, setState) {
          return Dialog(
            backgroundColor: Colors.grey[100], // Cor de fundo do Dialog
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.9,
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: <Widget>[
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 16.0),
                    child: Align(
                      alignment: Alignment.centerLeft,
                      child: Text(
                        'Selecionar Frequência',
                        style: TextStyle(fontSize: 14, color: Colors.grey),
                      ),
                    ),
                  ),
                  Wrap(
                    alignment: WrapAlignment.center,
                    children: <Widget>[
                      _buildDayButton(
                        day: null,
                        isSelected: selectedDay == null,
                        onPressed: () {
                          setState(() {
                            selectedDay = null;
                          });
                        },
                      ),
                      for (int i = 1; i <= 7; i++)
                        _buildDayButton(
                          day: i,
                          isSelected: selectedDay == i,
                          onPressed: () {
                            setState(() {
                              selectedDay = i;
                            });
                          },
                        ),
                    ],
                  ),
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 26.0, vertical: 9.0),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                        TextButton(
                          child: const Text('Fechar', style: TextStyle(color: Colors.green)),
                          onPressed: () => Navigator.of(context).pop(),
                        ),
                        SizedBox(width: 4.0), 
                        TextButton(
                          child: const Text('Confirmar', style: TextStyle(color: Colors.green)),
                          onPressed: () => Navigator.of(context).pop(selectedDay),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          );
        },
      );
    },
  );
}


Widget _buildDayButton({required int? day, required bool isSelected, required VoidCallback onPressed}) {
  return Padding(
    padding: const EdgeInsets.all(4.0),
    child: ElevatedButton(
      onPressed: onPressed,
      style: ElevatedButton.styleFrom(
        backgroundColor: isSelected ? Colors.green : Colors.grey[300],
        foregroundColor: isSelected ? Colors.white : Colors.black,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8.0)),
      ),
      child: Text(day == null ? 'Todos' : _getDayShortName(day)),
    ),
  );
}

String _getDayShortName(int weekday) {
  switch (weekday) {
    case 1:
      return 'Seg';
    case 2:
      return 'Ter';
    case 3:
      return 'Qua';
    case 4:
      return 'Qui';
    case 5:
      return 'Sex';
    case 6:
      return 'Sáb';
    case 7:
      return 'Dom';
    default:
      return '';
  }
}


}















