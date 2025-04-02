
import 'package:awesome_notifications/awesome_notifications.dart';
import 'package:flutter/material.dart';

class NotificationService {
  static Future<void> initializeNotifications() async {
    await AwesomeNotifications().initialize(
      null, //'resource://drawable/res_app_icon',
      [
        NotificationChannel(
          channelKey: 'alerts',
          channelName: 'Notifications',
          channelDescription: 'Notificações Importantes',
          playSound: true,
          onlyAlertOnce: true,
          groupAlertBehavior: GroupAlertBehavior.Children,
          importance: NotificationImportance.Max,
          defaultPrivacy: NotificationPrivacy.Private,
          defaultColor: const Color(0xFFF1268C),
          ledColor: const Color.fromARGB(255, 221, 71, 226),
          criticalAlerts: true,
        ),
        NotificationChannel(
          channelKey: 'student', // Notificações que o usuário agenda
          channelName: 'Routine',
          channelDescription: 'Meu Cronograma de Estudo',
          playSound: true,
          onlyAlertOnce: true,
          groupAlertBehavior: GroupAlertBehavior.Children,
          importance: NotificationImportance.Max,
          defaultPrivacy: NotificationPrivacy.Private,
          defaultColor: const Color.fromARGB(255, 28, 154, 192),
          ledColor: const Color.fromARGB(255, 71, 86, 226),
          criticalAlerts: true,
        ),
      ],
      debug: true,
    );
  }

  static Future<void> showInstantNotification({
    required String title,
    required String body,
  }) async {
    await AwesomeNotifications().createNotification(
      content: NotificationContent(
        id: -1,
        channelKey: 'alerts',
        title: title,
        body: body,
        notificationLayout: NotificationLayout.BigText,
        backgroundColor: const Color.fromARGB(255, 163, 8, 143),
      ),
    );
  }


  static Future<void> initializeListeners() async {
    AwesomeNotifications().setListeners(
      onActionReceivedMethod: onActionReceivedMethod,
      onNotificationCreatedMethod: onNotificationCreatedMethod,
      onNotificationDisplayedMethod: onNotificationDisplayedMethod,
      onDismissActionReceivedMethod: onDismissActionReceivedMethod,
    );
  }


  static Future<void> onActionReceivedMethod(ReceivedAction receivedAction) async {
    debugPrint('Ação de notificação recebida: ${receivedAction.actionType}');
  }

  static Future<void> onNotificationCreatedMethod(ReceivedNotification receivedNotification) async {
    debugPrint('Notificação criada: ${receivedNotification.id}');
  }

  static Future<void> onNotificationDisplayedMethod(ReceivedNotification receivedNotification) async {
    debugPrint('Notificação exibida: ${receivedNotification.id}');
  }

  static Future<void> onDismissActionReceivedMethod(ReceivedAction receivedAction) async {
    debugPrint('Notificação dispensada: ${receivedAction.id}');
  }


 static Future<void> requestNotificationPermission() async {
  AwesomeNotifications().isNotificationAllowed().then(
      (isAllowed) async {
        if (!isAllowed) {
          await AwesomeNotifications().requestPermissionToSendNotifications();
        }
      },
    );
 }




  static Future<void> scheduleDailyStudyNotification({ required int id, required String title, required String body, required int hour, required int minute, required bool repeat, required int? weekday }) async {
    String localTimeZone = await AwesomeNotifications().getLocalTimeZoneIdentifier();
    if (weekday == 0){ weekday = null;}
    debugPrint('Fuso horário: $localTimeZone');
    await AwesomeNotifications().createNotification(
      content: NotificationContent(
        id: id, 
        channelKey: 'student', 
        title: title,
        body: body,
        wakeUpScreen: true,
        backgroundColor: const Color(0xFFF1268C),
      ),
      schedule: NotificationCalendar(hour: hour, minute: minute, second: 0, timeZone: localTimeZone, repeats: repeat, weekday: weekday, allowWhileIdle: true),
    );
    debugPrint('📅 Notificação $id agendada para: $hour:$minute $localTimeZone');
  }


static Future<void> removeChanelNotifications(String channelKey) async {
  await AwesomeNotifications().cancelNotificationsByChannelKey(channelKey);
}



static Future<void> printScheduledNotifications() async {
  List<NotificationModel> scheduledNotifications =
      await AwesomeNotifications().listScheduledNotifications();

  if (scheduledNotifications.isEmpty) {
    debugPrint("📭 Nenhuma notificação agendada.");
  } else {
    debugPrint("📅 Notificações agendadas:");
    for (var notification in scheduledNotifications) {
      debugPrint("🆔 ID: ${notification.content?.id}");
      debugPrint("🔔 Título: ${notification.content?.title}");
      debugPrint("📄 Corpo: ${notification.content?.body}");
      debugPrint("⏰ Data/Hora: ${notification.schedule}");
      debugPrint("📍 Canal: ${notification.content?.channelKey}");
      debugPrint("------------------------------------");
    }
  }
}


// Função para mostrar as notificações agendadas em um dialog
  static void showScheduledNotificationsModal(BuildContext context) async {
    List<NotificationModel> scheduledNotifications =
        await AwesomeNotifications().listScheduledNotifications();

    // Verifica se há notificações agendadas
    if (scheduledNotifications.isEmpty) {
      showModalBottomSheet(
        context: context,
        builder: (context) {
          return Padding(
            padding: const EdgeInsets.all(16.0),
            child: const Text(
              'Nenhuma notificação agendada.',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
            ),
          );
        },
      );
    } else {
      showModalBottomSheet(
        context: context,
        builder: (context) {
          return Padding(
            padding: const EdgeInsets.all(16.0),
            child: ListView.builder(
              itemCount: scheduledNotifications.length,
              itemBuilder: (context, index) {
                var notification = scheduledNotifications[index];
                return ListTile(
                  title: Text(notification.content?.title ?? 'Sem título'),
                  subtitle: Text(
                      '${notification.content?.body ?? 'Sem corpo'}\nScheduled for: ${notification.schedule}'),
                  isThreeLine: true,
                );
              },
            ),
          );
        },
      );
    }
  }

}