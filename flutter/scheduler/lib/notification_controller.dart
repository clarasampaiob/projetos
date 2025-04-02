import 'package:awesome_notifications/awesome_notifications.dart';

class NotificationController {
  static Future<void> onActionReceivedMethod(ReceivedAction receivedAction) async {
    print('Ação de notificação recebida: ${receivedAction.actionType}');
  }

  static Future<void> onNotificationCreatedMethod(ReceivedNotification receivedNotification) async {
    print('Notificação criada: ${receivedNotification.id}');
  }

  static Future<void> onNotificationDisplayedMethod(ReceivedNotification receivedNotification) async {
    print('Notificação exibida: ${receivedNotification.id}');
  }

  static Future<void> onDismissActionReceivedMethod(ReceivedAction receivedAction) async {
    print('Notificação dispensada: ${receivedAction.id}');
  }
}