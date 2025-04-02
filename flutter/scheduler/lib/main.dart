


import 'package:flutter/material.dart';
import 'notifications.dart';
import 'notification_screen.dart';
import 'package:intl/intl.dart';
import 'dart:ui';

// import 'notification_controller.dart';
// import 'package:awesome_notifications/awesome_notifications.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await startNotifications();
  runApp(const MyApp());
   String deviceLanguage = getDeviceLanguage();
  debugPrint('Código do idioma do dispositivo: $deviceLanguage');
}


Future<void> startNotifications() async {
  await NotificationService.initializeNotifications();
  await NotificationService.requestNotificationPermission();
  await NotificationService.initializeListeners();
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Notificações',
      home: NotificationScreen(),
    );
  }
}


String getDeviceLanguage() {
  try {
    Locale locale = PlatformDispatcher.instance.locale;
    String languageCode = Intl.canonicalizedLocale(locale.toString());
    // Divida a string e pegue a primeira parte (o código do idioma)
    return languageCode.split('_')[0];
  } catch (e) {
    // Tratar erros caso PlatformDispatcher falhe por algum motivo.
    return Intl.defaultLocale?.split('_')[0] ?? 'en';
  }
}