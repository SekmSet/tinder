import {
  StyleSheet,
  Button,
  View,
  SafeAreaView,
  Text,
  Image,
  TextInput,
  ScrollView,
  ActivityIndicator,
} from "react-native";
import React, { useEffect, useState } from "react";
import { getMessage, send } from "../../../service/message";

export const ViewDetailMessaging = ({ route, navigation }) => {
  const [text, setText] = useState(null);
  const [idSender, setIdSender] = useState(1);
  const [idreceiver, setIdReceiver] = useState(null);
  const [profil, setProfil] = useState(null);
  const [messages, setMessages] = useState([]);

  const sendMessage = () => {
    send(idSender, text, idreceiver);
    setText("");
  };

  useEffect(() => {
    setIdReceiver(route.params.idreceiver);
    setProfil(route.params.profil);
    getMessage(idSender, route.params.idreceiver).then((mes) => {
      console.log(mes);
      setMessages(mes);
    });
  }, []);

  console.log(messages);
  return (
    <ScrollView>
      <SafeAreaView>
        <View style={styles.container}>
          <Image
            source={{ uri: profil?.images[0].url }}
            style={{ width: 60, height: 60, borderRadius: 60 / 2 }}
          />
          <Text>
            {profil?.last_name} {profil?.first_name}
          </Text>

          <View>
            {messages.map((message, index) => (
              <View key={index}>
                <Text>{message.text}</Text>
              </View>
            ))}
          </View>

          <TextInput
            style={styles.input}
            onChangeText={setText}
            value={text}
            placeholder=""
            keyboardType="numeric"
          />

          <Button
            // backgroundColor="#ff69b4"
            color="#ff6b4"
            style={styles.button}
            title="Envoyer"
            onPress={sendMessage}
          >
            Envoyer
          </Button>
        </View>
      </SafeAreaView>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    borderRadius: 10,
    margin: 10,
    padding: 10,
  },
  input: {
    backgroundColor: "white",
    borderColor: "black",
    height: 50,
    padding: 3,
  },
  message: {
    backgroundColor: "blue",
    color: "white",
  },
});
