import {
  StyleSheet,
  Button,
  View,
  SafeAreaView,
  Text,
  Image,
  TextInput,
} from "react-native";
import React, { useEffect, useState } from "react";
import { getMessage, send } from "../../../service/message";

export const ViewDetailMessaging = ({ route, navigation }) => {
  const [text, setText] = useState(null);
  const [idSender, setIdSender] = useState(1);
  const [idreceiver, setIdReceiver] = useState(null);
  const [profil, setProfil] = useState(null);
  const [messages, setMessages] = useState(null);

  const sendMessage = () => {
    send(idSender, text, idreceiver);
    setText("");
  };

  useEffect(() => {
    setIdReceiver(route.params.idreceiver);
    setProfil(route.params.profil);

    setMessages(getMessage(idSender, route.params.idreceiver));
  }, []);

  return (
    <SafeAreaView>
      <View style={styles.container}>
        <Image
          source={{ uri: profil?.images[0].url }}
          style={{ width: 60, height: 60, borderRadius: 60 / 2 }}
        />
        <Text>
          {profil?.last_name} {profil?.first_name}
        </Text>

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
  button: {},
});
