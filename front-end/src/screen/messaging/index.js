import {StyleSheet, Button, View, SafeAreaView, Text, Alert, Image} from 'react-native';
import React from 'react';

export const ViewAllMessaging = () => {
    return (
        <SafeAreaView>
            <View style={styles.container}>
               <Text>Mes messages</Text>
            </View>
        </SafeAreaView>
    )
}

const styles = StyleSheet.create({
    container: {
        borderRadius: 10,
        margin: 10,
        padding: 10,
    }
})