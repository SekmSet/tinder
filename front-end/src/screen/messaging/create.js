import {
  StyleSheet,
  Button,
  View,
  SafeAreaView,
  Text,
  Alert,
  Image,
} from "react-native";
import React from "react";

export const CreateMessaging = ({ navigation }) => {
  return (
    <SafeAreaView>
      <View style={styles.container}>
        <Text>Nouveau message</Text>
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
});
